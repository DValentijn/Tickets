<x-app-layout>

<form action="{{ url('/tickets') }}" method="POST">
    @csrf
    <label for="title">Name of the Ticket:</label>
    <input type="text" id="title" name="title" required><br><br>

    <label for="description">Description of the Ticket:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="user_id">User of the Ticket:</label>
    <select id="user_id" name="user_id">
        @forelse ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @empty
        <option disabled>No Users Available</option>
    @endforelse
    </select><br><br>

    <label for="scrumboard">Ticket Scrumboard URL:</label>
    <input type="url" id="scrumboard" name="scrumboard"><br><br>

    <label for="status">Status of Ticket:</label>
    <select id="status" name="status">
        <option value="open">Open</option>
        <!-- Add other status options if necessary -->
    </select><br><br>

    <input type="submit" class="button" value="Submit">
</form>
</x-app-layout>

<style>
    form input, select {
        color: black;
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

    </style>
