@if ($activeTournaments->count() == 1)
    @include('website.include.card-header')
@elseif(isset($tournament))
    @include('website.include.card-header')
{{--    <div class="card-header p-0 pt-1">--}}
{{--        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">--}}
{{--            @foreach ($activeTournaments as $activeTournament)--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link anchor @if($activeTournament->id == $tournament->id) active @endif" href="{{route('result.tournament',['club_id'=> $activeTournament->club_id,'tournament_id'=>$activeTournament->id])}}" >{{$activeTournament->name}}</a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
@endif
