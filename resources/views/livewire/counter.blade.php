<div>
    <div class="col-md-2">
    <input wire:model="search" class="not-click form-control " name="search" value=" " type="text" placeholder="Search users..."/>
</div>
    <ul>



        @if(isset($users))
                {{ $users->links() }}
        @foreach($users as $user)
            <li>{{ $user->name }}</li>

        @endforeach

        @else
        <p> </p>
        @endif

    </ul>

</div>
