<div>
    {{-- @php
        echo '<pre>';
        print_r($chat_status);
    @endphp --}}
    {{-- @include('sweetalert::alert') --}}
    {{ $alert }}
    <div class="container" style="margin-top: 25px;">
        <div class="row justify-content-center align-items-center p-0">
            <div class="card p-0">
                <div class="card-header">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-lg-10">
                            <h4 class="text-primary">All active and deactivated chats between users </h4>
                        </div>
                        <div class="col-lg-2 justify-content-end align-items-end">
                            <a class="btn btn-primary" href="{{ route('add-agent') }}">Manage Accounts</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>Chat Id</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div>
                                <div>
                                    @php
                                        $i = 0;
                                    @endphp
                                </div>
                                @foreach ($users as $user)
                                    <tr>
                                        <input type="hidden" class="action_id" value="{{ $user['id'] }}">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user['sender']['name'] }}</td>
                                        <td>{{ $user['sender']['email'] }}</td>
                                        <td>{{ $user['message'] }}</td>
                                        <td><a href="" class="btn text-primary m-0 p-0" id="replybtn"
                                                wire:click.prevent="replyUser({{ $user['receiver_id'] }},{{ $user['chat_number'] }})"><i
                                                    class="bi bi-reply-fill" style="font-size: 2rem;"></i></a>&nbsp;<a
                                                href="" class="btn text-warning m-0 p-0" id="dltbtn"
                                                wire:click.prevent="deactivateChat({{ $user['chat_number'] }})"><i
                                                    class="bi bi-dash-circle" style="font-size: 2rem;"></i></a>
                                            &nbsp;<a href="" class="btn text-danger m-0 p-0" id="dltbtn"
                                                wire:click.prevent="deleteChat({{ $user['chat_number'] }})"><i
                                                    class="bi bi-trash" style="font-size: 2rem;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </div>
                        </tbody>
                    </table>
                    <div class="replybox rounded" id="replybox" wire:ignore.self>
                        <div class="card" id="chat2">
                            <div class="card-header px-5 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Chat</h5>
                                <button type="button" class="btn btn-danger btn-lg" id="replyboxclose"
                                    data-mdb-ripple-color="dark">
                                    X</button>
                            </div>
                            <div class="card-body m-0 px-5" data-mdb-perfect-scrollbar="true"
                                style="position: relative;">
                                <div class="overflow-auto p-2" style="height: 290px;" wire:poll="replyUser">
                                    <div>
                                        @if ($chat != [])

                                            <div>
                                                @foreach ($chat as $ct)
                                                    <div>
                                                        @if ($ct['sender_id'] == $me)
                                                            <div class="d-flex flex-row justify-content-end ms-1">
                                                                <p class="p-2 mb-1 mt-1 rounded-3 ms-2"
                                                                    style="background-color: lightsalmon">
                                                                    <strong>
                                                                        {{ $ct['sender']['name'] }}
                                                                    </strong><br>
                                                                    {{ $ct['message'] }}
                                                                </p>
                                                                <img src="{{ asset('storage/user/' . $ct['sender']['image']) }}"
                                                                    alt="avatar 1" style="width: 45px; height: 100%;">
                                                            </div>
                                                        @else
                                                            <div>
                                                                @if ($ct['sender']['type'] == 'AGT')
                                                                    <div
                                                                        class="d-flex flex-row justify-content-start ms-1">
                                                                        <img src="{{ asset('storage/user/' . $ct['sender']['image']) }}"
                                                                            alt="avatar 1"
                                                                            style="width: 45px; height: 100%;">
                                                                        <p class="small p-2 mb-1 mt-1 rounded-3 ms-2"
                                                                            style="background-color: skyblue;">
                                                                            <strong class="text-danger">Agent:
                                                                                {{ $ct['sender']['name'] }}
                                                                            </strong><br>
                                                                            {{ $ct['message'] }}
                                                                        </p>
                                                                    </div>
                                                                @elseif ($ct['sender']['type'] == 'ADM')
                                                                    <div
                                                                        class="d-flex flex-row justify-content-start ms-1">
                                                                        <img src="{{ asset('storage/user/' . $ct['sender']['image']) }}"
                                                                            alt="avatar 1"
                                                                            style="width: 45px; height: 100%;">
                                                                        <p class="small p-2 mb-1 mt-1 rounded-3 ms-2"
                                                                            style="background-color: lightsalmon;">
                                                                            <strong class="text-danger">Admin:
                                                                                {{ $ct['sender']['name'] }}
                                                                            </strong><br>
                                                                            {{ $ct['message'] }}
                                                                        </p>
                                                                    </div>
                                                                @else
                                                                    <div
                                                                        class="d-flex flex-row justify-content-start ms-1">
                                                                        <img src="{{ asset('storage/user/' . $ct['sender']['image']) }}"
                                                                            alt="avatar 1"
                                                                            style="width: 45px; height: 100%;">
                                                                        <p class="small p-2 mb-1 mt-1 rounded-3 ms-2"
                                                                            style="background-color: #f5f6f7">
                                                                            <strong class="text-primary">Customer:
                                                                                {{ $ct['sender']['name'] }}</strong><br>
                                                                            {{ $ct['message'] }}
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div>
                                @if ($chat_status)
                                    <div
                                        class="card-footer text-muted d-flex justify-content-start align-items-center px-5">
                                        <form action="" wire:submit.prevent="sendMsg">

                                            <div class="input-group my-3" style="width: 500px">
                                                <input type="text" class="form-control" name="message"
                                                    placeholder="Type..." wire:model="message" />
                                                <span class="input-group-text bg-primary" id="basic-addon2"><button
                                                        class="btn btn-primary float-left" type="submit"><i
                                                            class="bi bi-send-fill"></i></button></span>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
