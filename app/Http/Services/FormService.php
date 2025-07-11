<?php

namespace App\Http\Services;

use Illuminate\Support\Arr;
use App\Repositories\FormRepository;

class FormService
{
    private $formRepository;
    public function __construct(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
    }
    public function create(array $data)
    {
        $data['company_id'] = Auth()->user()->company_id;
        $data['created_by'] = Auth()->user()->id;

        $checkExistField = $this->getFormFieldsByCompanyId($data['company_id']);
        if ($checkExistField) {
            $checkExistField->formfield()->delete();
            $checkExistField->delete();
        }

        $form = $this->formRepository->create(Arr::except($data, ['fieldDetails', '_token']));

        foreach ($data['fieldDetails'] as $field) {
            if (isset($field['key']) && !empty($field['key'])) {
                $merged = array_combine($field['key'], $field['value']);
                $field['options'] = json_encode($merged, JSON_PRETTY_PRINT);
            }

            $form->formfield()->create([
                'label' => $field['label'],
                'type' => $field['type'],
                'required' => isset($field['required']) ? (int) $field['required'] : 1,  // ← add this line
                'options' => $field['options'] ?? NULL
            ]);
        }

        return true;
    }

    public function getFormFieldsByCompanyId($companyId)
    {
        return $this->formRepository->where('company_id', $companyId)->first();
    }
}
