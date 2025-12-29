@extends('website.layouts.master')

@push('css')
@endpush
@section('content')
    <div class="container-fluid content">
        <div class="card card-primary card-tabs">
            {{-- Info:Tournament Tab header --}}
            <div class="card-header shadow-lg text-color">
                <h3>{{ $club->name}}</h3>
            </div>
            {{-- Tournament Detail  --}}
            <div class="card-body">
                @foreach ($tournaments as $tournament)
                    @php
                        $currentTournamentResult = $tournamentsPositions->only($tournament->id)->first();
                    @endphp
                    <div class="event">
                        <a href="{{route('result.tournament',['club_id'=> 'default','tournament_id'=>$tournament->id])}}"
                           title="results of {{$tournament->name}}">
                            <img
                                @if($tournament->poster)
                                    src="{{asset('uploads/'.$tournament->poster)}}"
                                @else
                                    src="{{asset('website/img/200x250.png')}}"
                                @endif
                                alt="{{$tournament->name}}"
                                class="img-thumbnail img-responsive poster">
                        </a>
                        <a href="{{route('result.tournament',['club_id'=> 'default','tournament_id'=>$tournament->id])}}"
                           title="results of {{$tournament->name}}">
                            <h4>{{$tournament->name}}</h4>
                        </a>
                        @php
                            $startDate = \Carbon\Carbon::parse($tournament->flyingDays->first()->date);
                            $startDate = $startDate->settings(['toStringFormat' => ' j F, Y']);
                            $lastDate = \Carbon\Carbon::parse($tournament->flyingDays->last()->date);
                            $lastDate = $lastDate->settings(['toStringFormat' => ' j F, Y']);
                        @endphp
                        <strong>{{$startDate}} - {{$lastDate}}</strong>
                        <table class="table table-striped table-sm ml-auto">
                            <thead>
                            <tr>
                                <th>Position</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Total</th>
                                <th>Prize</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($currentTournamentResult != null)
                                @foreach ($currentTournamentResult as $player_id => $data)
                                    @php
                                        $seconds = $data[2]??0;
                                        $hours = floor($seconds / 3600);
                                        $seconds -= $hours * 3600;
                                        $minutes = floor($seconds / 60);
                                        $seconds -= $minutes * 60;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{$data[0]}}</td>
                                        <td class="city">{{$data[1]}}</td>
                                        <td class="time">{{sprintf("%02d", $hours)}}:{{sprintf("%02d", $minutes)}}
                                            :{{sprintf("%02d", $seconds)}}</td>
                                        <td class="prize">{{$data[3]}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
            <!-- /.card -->
            <div class="card-footer">
                {{ $tournaments->links() }}
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
