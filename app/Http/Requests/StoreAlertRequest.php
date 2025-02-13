<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Http\Exceptions\HttpResponseException;

    class StoreAlertRequest extends FormRequest {

        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool {
            return $this->user()->role === "administrador" || $this->user() === "coordinador" || $this->user() === "teleoperador";
        }

        protected function failedAuthorization() {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'No tienes permiso para realizar esta acción'
            ], 403));
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules(): array {
            return [
                //
            ];
        }
    }
?>