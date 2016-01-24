@foreach($entity->photos as $filename)

    <img src="{{ url('images/small/' . $filename) }}" alt="">

@endforeach