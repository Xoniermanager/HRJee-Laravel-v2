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
  public function all()
  {
    return $this->languageRepository->orderBy('id','DESC')->paginate(10);
  }

  /*
  Returning the list of default languages when on boarding an employee.
  Currently it is set to Hindi & English, which can be changed later
  */
  public function defaultLanguages()
  {
    return $this->languageRepository->whereIn('name',['Hindi','English'])->orderBy('id','DESC')->get();
  }

  /*
  Returning the list of languages details as per the provided language ids.
  */
  public function getSelectedLanguage($languages)
  {
    return $this->languageRepository->whereIn('id',$languages)->orderBy('id','DESC')->get();
  }

  public function createOrUpdate(array $data)
  {
    return $this->languageRepository->updateOrCreate($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->languageRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->languageRepository->find($id)->delete();
  }
}
