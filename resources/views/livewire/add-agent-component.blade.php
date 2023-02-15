<div class="container" style="margin-top: 30px; height: 70%">
    <div class="row justify-content-center align-items-center g-2">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-lg-6 text-primary">
                            <h4>All users and their status</h4>
                        </div>
                        <div class="col-lg-6 justify-content-end align-items-end">
                            <a href="{{ route('admin-dashboard') }}" class="btn btn-primary float-end">Dashboard</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Switch roles</th>
                            </tr>
                        </thead>
                        <tbody wire:poll>
                            <div>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>
                                            <div>
                                                @php
                                                    if ($user['type'] == 'ADM') {
                                                        echo '<span class="text-primary">Admin</span>';
                                                    }
                                                    if ($user['type'] == 'AGT') {
                                                        echo '<span class="text-success">Agent</span>';
                                                    }
                                                    if ($user['type'] == 'USR') {
                                                        echo '<span class="text-warning">User</span>';
                                                    }
                                                @endphp
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                @if ($user['type'] == 'ADM')
                                                    <a href="" wire:click.prevent="makeUser({{ $user['id'] }})"
                                                        class="text-warning">User</a> | <a href=""
                                                        wire:click.prevent="makeAgent({{ $user['id'] }})"
                                                        class="text-success">Agent</a>
                                                @elseif($user['type'] == 'AGT')
                                                    <a href="" wire:click.prevent="makeUser({{ $user['id'] }})"
                                                        class="text-warning">User</a> | <a href=""
                                                        wire:click.prevent="makeAdmin({{ $user['id'] }})"
                                                        class="text-primary">Admin</a>
                                                @elseif($user['type'] == 'USR')
                                                    <a href=""
                                                        wire:click.prevent="makeAgent({{ $user['id'] }})"
                                                        class="text-success">Agent</a> | <a href=""
                                                        wire:click.prevent="makeAdmin({{ $user['id'] }})"
                                                        class="text-primary">Admin</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
