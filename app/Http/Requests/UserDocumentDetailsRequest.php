<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Services\DocumentTypeService;
class UserDocumentDetailsRequest extends FormRequest
{
    private $documentTypeService;
    public function __construct(DocumentTypeService $documentTypeService)
    {
        $this->documentTypeService = $documentTypeService;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $allDocuments = $this->documentTypeService->getAllActiveDocuments();
        $rules = array();

        foreach($allDocuments as $document)
        {
            $required = ($document->is_mandatory) ? 'required' : '';
            $rule = array(
                removingSpaceMakingName($document->name) =>  "{$required}|file|mimes:jpeg,png,jpg,gif,svg|max:2048",
                'document_' . removingSpaceMakingName($document->name) =>  "{$required} | exists:document_types,id"
            );
            $rules = array_merge($rules,$rule);
        }

        $rule = array(
            'user_id'           =>  'required | exists:users,id'
        );
        $rules = array_merge($rules,$rule);
        return $rules;
    }
}
