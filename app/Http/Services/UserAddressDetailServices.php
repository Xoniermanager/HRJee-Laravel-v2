<?php

namespace App\Http\Services;

use App\Repositories\UserAddressDetailRepository;

class UserAddressDetailServices
{
  private $userAddressDetailRepository;
  public function __construct(UserAddressDetailRepository $userAddressDetailRepository)
  {
    $this->userAddressDetailRepository = $userAddressDetailRepository;
  }

  public function create(array $data)
  {
    $address_type = $data['address_type'];
    $user_id = $data['user_id'];
    $payload = array();

    if ($address_type == '0') {

      $local_address_name = 'local';

      $payload[] = [
        'address_type'        => $local_address_name,
        'country_id'          => $data['l_country_id'],
        'state_id'            => $data['l_state_id'],
        'address'             => $data['l_address'],
        'city'                => $data['l_city'],
        'pin_code'            => $data['l_pincode'],
        'user_id'             => $user_id,
      ];

      // Check if a record exists with below details
      // type=local & user_id
      // if exists update all attributes otherwise create
      $get_local_already_existing_details = $this->checkExistingDetails($user_id, $local_address_name);

      $get_both_same_already_existing_details = $this->checkExistingDetails($user_id, 'both_same');
      if ($get_both_same_already_existing_details != null) {
        $get_both_same_already_existing_details->delete();
      }

      if (isset($get_local_already_existing_details)) {
        $response = $this->userAddressDetailRepository->find($get_local_already_existing_details->id)->update($payload[0]);
      }
      if (!isset($get_local_already_existing_details)) {
        $response = $this->userAddressDetailRepository->create($payload[0]);
      }

      $premanent_address_name = 'permanent';

      $payload[] = [
        'address_type'        => $premanent_address_name,
        'country_id'          => $data['p_country_id'],
        'state_id'            => $data['p_state_id'],
        'address'             => $data['p_address'],
        'city'                => $data['p_city'],
        'pin_code'            => $data['p_pincode'],
        'user_id'             => $user_id,
      ];

      // Check if a record exists with below details
      // type=local & user_id
      // if exists update all attributes otherwise create

      $get_premanent_already_existing_details = $this->checkExistingDetails($user_id, $premanent_address_name);
      if (isset($get_premanent_already_existing_details)) {
        $response = $this->userAddressDetailRepository->find($get_local_already_existing_details->id)->update($payload[1]);
      }
      if (!isset($get_premanent_already_existing_details)) {
        $response = $this->userAddressDetailRepository->create($payload[1]);
      }
    } else {

      $payload[] = [
        'address_type'        => 'both_same',
        'country_id'          => $data['l_country_id'],
        'state_id'            => $data['l_state_id'],
        'address'             => $data['l_address'],
        'city'                => $data['l_city'],
        'pin_code'            => $data['l_pincode'],
        'user_id'             => $user_id,
      ];

      // chck if any address exists for current user with local and permanenet 
      // if exists delete them then create a new address with type=both

      $get_local_already_existing_details = $this->checkExistingDetails($user_id, 'local');
      $get_premanent_already_existing_details = $this->checkExistingDetails($user_id, 'permanent');
      if (isset($get_local_already_existing_details) || isset($get_premanent_already_existing_details)) {
        $get_local_already_existing_details->delete();
        $get_premanent_already_existing_details->delete();
      }
      $get_both_same_already_existing_details = $this->checkExistingDetails($user_id, 'both_same');
      if (isset($get_both_same_already_existing_details)) {
        $response = $this->userAddressDetailRepository->find($get_both_same_already_existing_details->id)->update($payload[0]);
      } else {
        $response = $this->userAddressDetailRepository->create($payload[0]);
      }
    }
    return  $response;
  }

  public function checkExistingDetails($user_id, $address_name)
  {
    return $this->userAddressDetailRepository->where('user_id', $user_id)->where('address_type', $address_name)->first();
  }
  public function getDetailById($id)
  {
    return $this->userAddressDetailRepository->where('user_id', $id)->get();
  }
  public function update($id, $addressId, $address_type, $data)
  {
    return $this->userAddressDetailRepository->where(['user_id' => $id, 'id' => $addressId,'address_type'=>$address_type])->update($data);
  }
}
