<div  id="skill_list" class="card-body">
    <div class="list-product">
        <div
            class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">

            <div class="datatable-container">
                <table class="table nowrap" id="project-status">
                    <thead>
                        <tr>
                            <th>
                                <span class="f-light f-w-600">Sr No.</span>
                            </th>
                            <th>
                                <span class="f-light f-w-600">skill Name</span>
                            </th>

                            <th>
                                <span class="f-light f-w-600">Status</span>
                            </th>


                            <th>
                                <span class="f-light f-w-600">Action</span>
                            </th>
                        </tr>
                    </thead>

                        @forelse ($allSkillDetails as $key => $skillDetail)
                            <tr>
                                <td>
                                    <p class="f-light">{{$key+1}}</p>
                                </td>

                                <td>
                                        <p class="f-light">{{ $skillDetail->name }}</p>
                                </td>
                                <td>
                                    <div class="form-check form-switch form-check-inline">
                                            <input type="checkbox" <?= $skillDetail->status == '1' ? 'checked' : '' ?>
                                            onchange="handleStatus({{ $skillDetail->id }})" id="checked_value_{{ $skillDetail->id }}" class="form-check-input switch-info check-size">
                                        <span class="slider round"></span>
                                    </div>
                                </td>

                                <td>
                                    <div class="product-action"><a href="#" data-bs-toggle="modal"
                                        data-bs-target="#edit_skill"
                                        onClick="edit_skill_details('{{ $skillDetail->id }}', '{{ $skillDetail->name }}')">
                                            <svg viewBox="0 -0.5 21 21" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <title>edit_cover [#1481]</title>
                                                    <desc>Created with Sketch.</desc>
                                                    <defs> </defs>
                                                    <g id="Page-1" stroke="none"
                                                        stroke-width="1" fill="none"
                                                        fill-rule="evenodd">
                                                        <g id="Dribbble-Light-Preview"
                                                            transform="translate(-419.000000, -359.000000)"
                                                            fill="#000000">
                                                            <g id="icons"
                                                                transform="translate(56.000000, 160.000000)">
                                                                <path
                                                                    d="M384,209.210475 L384,219 L363,219 L363,199.42095 L373.5,199.42095 L373.5,201.378855 L365.1,201.378855 L365.1,217.042095 L381.9,217.042095 L381.9,209.210475 L384,209.210475 Z M370.35,209.51395 L378.7731,201.64513 L380.4048,203.643172 L371.88195,212.147332 L370.35,212.147332 L370.35,209.51395 Z M368.25,214.105237 L372.7818,214.105237 L383.18415,203.64513 L378.8298,199 L368.25,208.687714 L368.25,214.105237 Z"
                                                                    id="edit_cover-[#1481]"> </path>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg></a>
                                         <a href="#" onclick="deleteFunction('{{ $skillDetail->id }}')">
                                        <svg viewBox="0 0 1024 1024" class="icon" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M154 260h568v700H154z" fill="#FF3B30">
                                                </path>
                                                <path
                                                    d="M624.428 261.076v485.956c0 57.379-46.737 103.894-104.391 103.894h-362.56v107.246h566.815V261.076h-99.864z"
                                                    fill="#030504"></path>
                                                <path
                                                    d="M320.5 870.07c-8.218 0-14.5-6.664-14.5-14.883V438.474c0-8.218 6.282-14.883 14.5-14.883s14.5 6.664 14.5 14.883v416.713c0 8.219-6.282 14.883-14.5 14.883zM543.5 870.07c-8.218 0-14.5-6.664-14.5-14.883V438.474c0-8.218 6.282-14.883 14.5-14.883s14.5 6.664 14.5 14.883v416.713c0 8.219-6.282 14.883-14.5 14.883z"
                                                    fill="#152B3C"></path>
                                                <path d="M721.185 345.717v-84.641H164.437z"
                                                    fill="#030504"></path>
                                                <path
                                                    d="M633.596 235.166l-228.054-71.773 31.55-99.3 228.055 71.773z"
                                                    fill="#FF3B30"></path>
                                                <path
                                                    d="M847.401 324.783c-2.223 0-4.475-0.333-6.706-1.034L185.038 117.401c-11.765-3.703-18.298-16.239-14.592-27.996 3.706-11.766 16.241-18.288 27.993-14.595l655.656 206.346c11.766 3.703 18.298 16.239 14.592 27.996-2.995 9.531-11.795 15.631-21.286 15.631z"
                                                    fill="#FF3B30"></path>
                                            </g>
                                        </svg>
                                         </a>
                                    </div>
                                </td>
                            </tr>

                @empty
                    <td colspan="3">
                        <span class="text-danger">
                            <strong>No skill Found!</strong>
                        </span>
                    </td>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
    <td class="mt-3">
        {{ $allSkillDetails->links('paginate') }}
    </td>
</div>
