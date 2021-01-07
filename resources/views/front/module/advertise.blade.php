@if(count($datas['advertise']) > 0)
<div class="hot-news-ads">
    <div class="row">
    @foreach($datas['advertise'] as $advertise)
        <a href="{{$advertise->href}}" target="_blank" class="{{$datas['class']}}"><img src="{{asset('/image/'.$advertise->image)}}" alt="image"></a>
    @endforeach
    </div>
</div>
@endif
