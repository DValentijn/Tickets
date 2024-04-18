<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>
{{-- 
@section('content') --}}
    {{-- <a href="{{ route('tickets.create') }}" class="btn btn-primary">Create Ticket</a> --}}

    @auth
        @if(auth()->user()->hasAnyRole(['Developer', 'Designer']))
            <a href="{{ route('tickets.create') }}" class="button">Create Ticket</a>
        @endif
    @endauth


    <div class="mt-3">
        <ul class="list-group">
        @foreach ($tickets as $ticket)
            <li class="list-group-item" style="margin-bottom: 10px;">
                {{ $ticket->title }}
                <a href="{{ route('tickets.show', $ticket->id) }}" class="ticketview">View Ticket</a>
            </li>
        @endforeach
        </ul>
    </div>
{{-- @endsection --}}

<style>
    .ticketview {
    background-color: #69a9e8;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
}

.button {
    background-color: #69a9e8;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
}

.list-group-item{
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-evenly;
    align-items: center;
    gap: 50px
}
</style>


</x-app-layout>
