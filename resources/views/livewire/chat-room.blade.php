<div>
    <div style="position: static;">
        <button type="button" id="chatbtn" class="btn btn-primary circlebtn close" data-bs-dismiss="alert"
            aria-label="Close"><i class="bi bi-chat-square-text text-white" style="font-size: 2rem;"
                wire:click.prevent="replyUser"></i></button>
        <div class="chatbox rounded" wire:ignore.self>
            <div class="card" id="chat2">
                <div class="card-header d-flex justify-content-end p-0 align-items-end bg-primary pb-4"
                    style="border: none;">
                    <button type="button" id="chatboxclose" class="btn btn-sm text-white"
                        data-mdb-ripple-color="dark">X</button>
                </div>
                <div class="card-body m-0 p-0" data-mdb-perfect-scrollbar="true" style="position: relative;">
                    <div class="overflow-auto" style="height: 290px;" wire:poll="replyUser">
                        <div>
                            @if ($chat == [])
                                <div class="bg-primary text-center text-white p-1" style="height: 150px;">
                                    <div class="mt-4">
                                        <h4>Sport Board Chat</h4>
                                        <small>We go beyond merely communicating to connecting the people. Chat
                                            now!</small>
                                    </div>
                                </div>
                            @else
                                <div class="m-2">
                                    @if (is_array($chat) || is_object($chat))
                                        <div>
                                            @foreach ($chat as $ct)
                                                <div>
                                                    @if ($ct['sender_id'] == $me)
                                                        <div class="d-flex flex-row justify-content-end">
                                                            <p class="small p-2 mb-1 mt-1 rounded-3 ms-2"
                                                                style="background-color: lightgreen">
                                                                <strong>{{ $ct['sender']['name'] }}</strong><br>
                                                                {{ $ct['message'] }}
                                                            </p>
                                                            <img class="ms-1"
                                                                src="{{ asset('storage/user/' . $ct['sender']['image']) }}"
                                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                                        </div>
                                                    @elseif ($ct['sender']['type'] != 'ADM' && $ct['sender']['type'] != 'USR')
                                                        <div class="d-flex flex-row justify-content-start ms-1">
                                                            <img src="{{ asset('storage/user/' . $ct['sender']['image']) }}"
                                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                                            <p class="small p-2 mb-1 mt-1 rounded-3 ms-2"
                                                                style="background-color: #f5f6f7">
                                                                <strong>Agent:
                                                                    {{ Str::ucfirst($ct['sender']['name']) }}</strong><br>
                                                                {{ $ct['message'] }}
                                                            </p>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted d-flex justify-content-start align-items-center">
                    <form action="" wire:submit.prevent="sendMsg" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="message" placeholder="Type..."
                                wire:model="message" />
                            <span class="input-group-text bg-primary" id="basic-addon2"><button
                                    class="btn btn-primary float-left" type="submit"><i
                                        class="bi bi-send-fill"></i></button></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
