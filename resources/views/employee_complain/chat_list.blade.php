    <div class="heightmin" id="chat_list">
        <!--begin::Message(in)-->
        @if (isset($complainDetails) && count($complainDetails) > 0)
            @foreach ($complainDetails as $chatDetails)
                <div
                    class="p-2 d-flex mb-10  {{ $chatDetails->from_id == $fromId ? 'justify-content-end' : 'justify-content-start' }}">
                    <!--begin::Wrapper-->
                    <div
                        class="d-flex flex-column {{ $chatDetails->from_id == $fromId ? 'align-items-end' : 'align-items-start' }}">
                        <!--begin::User-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-35px symbol-circle chat-user"><img alt="Pic"
                                    src="{{ Auth()->guard('employee')->user()->profile_image }}">
                            </div><!--end::Avatar-->
                            <!--begin::Details-->
                            <div class="ms-3">
                                <!--begin::Text-->
                                <div class="chatboxxleft mw-lg-400px text-start" data-kt-element="message-text">
                                    {{ $chatDetails->message }}</div>
                                <!--end::Text-->
                                <span class="text-muted fs-7 mb-1">{{ $chatDetails->created_at->format('m:i a') }}</span>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            @endforeach
        @else
            <div class="d-flex align-items-center mb-2">
                No Conversation Message
            </div>
            <!--end::User-->
        @endif
    </div>
