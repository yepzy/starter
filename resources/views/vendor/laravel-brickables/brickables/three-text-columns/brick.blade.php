<div class="container">
    <div class="row mb-n3">
        <div class="col-md-4 text">
            {{-- ToDo: replace `translatedData` by `data_get` if your app is not multilingual --}}
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_left')) !!}
        </div>
        <div class="col-md-4 text">
            {{-- ToDo: replace `translatedData` by `data_get` if your app is not multilingual --}}
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_center')) !!}
        </div>
        <div class="col-md-4 text">
            {{-- ToDo: replace `translatedData` by `data_get` if your app is not multilingual --}}
            {!! (new Parsedown)->text(translatedData($brick, 'data.text_right')) !!}
        </div>
    </div>
</div>
