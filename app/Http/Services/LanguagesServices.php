<?php

namespace App\Http\Services;

use App\Repositories\LanguagesRepository;


class LanguagesServices
{
  private $languageRepository;
  public function __construct(LanguagesRepository $languageRepository)
  {
    $this->languageRepository = $languageRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->languageRepository->orderBy('id','DESC')->paginate(10);
  }

  /**
   * Returning the list of default languages when on boarding an employee.
   * Currently it is set to Hindi & English, which can be changed later
   *
   * @return void
   */
  public function defaultLanguages()
  {
    return $this->languageRepository->whereIn('name',['Hindi','English'])->orderBy('id','DESC')->get();
  }

  /**
   * Returning the list of languages details as per the provided language ids.
   *
   * @param [type] $languages
   * @return void
   */
  public function getSelectedLanguage($languages)
  {
    return $this->languageRepository->whereIn('id',$languages)->orderBy('id','DESC')->get();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function createOrUpdate(array $data)
  {
    return $this->languageRepository->updateOrCreate($data);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->languageRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->languageRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $searchKey
   * @return void
   */
  public function searchInLanguages($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->languageRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }
}
