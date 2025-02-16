<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Resources\LanguageResource;
    use App\Http\Requests\Api\{
        StoreLanguageRequest,
        UpdateLanguageRequest
    };
    use App\Models\Language;
    use Illuminate\Http\Request;

    class LanguageController extends BaseController {

        /**
         * Display a listing of the resource.
         */
        public function index() {
            return LanguageResource::collection(Language::paginate(100));
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(StoreLanguageRequest $request) {
            $language = Language::create($request->validated());
            return $this->sendResponse(new LanguageResource($language), 'Idioma creado con éxito', 201);
        }

        /**
         * Display the specified resource.
         */
        public function show(Language $language) {
            return $this->sendResponse(new LanguageResource($language), 'Idioma mostrado con éxito', 201);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(UpdateLanguageRequest $request, Language $language) {
            $language->update($request->validated());
            return $this->sendResponse(new LanguageResource($language), 'Idioma actualizado con éxito', 200);
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Language $language) {
            $language->teleoperators()->detach();
            $language->delete();
            return $this->sendResponse(null, 'Idioma eliminado con éxito', 204);
        }
    }
?>