<div class="container">
    <div class="row">
        <div class="col-12">
            {!! (new Parsedown)->text(translate(data_get($brick, 'data.text'))) !!}
        </div>
    </div>
</div>
