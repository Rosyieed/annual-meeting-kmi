<h3>Vote for Group Leader in {{ $group->txtGroupName }}</h3>

<form action="{{ route('groups.vote', $group->intGroup_ID) }}" method="POST">
    @csrf
    <ul>
        @foreach ($members as $member)
            <li>
                <input type="radio" name="leader_id" value="{{ $member->intUser_ID }}" id="leader{{ $member->intUser_ID }}">
                <label for="leader{{ $member->intUser_ID }}">{{ $member->txtName }}</label>
            </li>
        @endforeach
    </ul>
    <button type="submit">Vote</button>
</form>
