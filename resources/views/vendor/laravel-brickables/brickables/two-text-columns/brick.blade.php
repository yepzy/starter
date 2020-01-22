<div class="container">
    <div class="row">
        <div class="col-md-6">
            {!! (new Parsedown)->text(translate(data_get($brick, 'data.text_left'))) !!}
        </div>
        <div class="col-md-6">
            {!! (new Parsedown)->text(translate(data_get($brick, 'data.text_right'))) !!}
        </div>
    </div>
</div>
