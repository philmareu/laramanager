<div class="uk-grid">
    <div class="uk-width-1-4">
        @foreach($object->data('images') as $image)
            <img src="{{ url('images/small/' . $image) }}" alt=""/>
        @endforeach
    </div>
</div>