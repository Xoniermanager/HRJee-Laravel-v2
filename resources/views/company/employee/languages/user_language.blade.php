@foreach ($userLanguages as $language)
                    <div class="row" id="language_{{ $language->id }}" style="min-height:37px">
                        <div class="col-md-2">{{ $language->name }}</div>
                        <input class="language" value="{{ $language->id }}" type="hidden"
                            name="language[{{ $language->id }}][language_id]">
                        <div class="col-md-9">
                            <div class="chkbox"> <label>Read</label>
                                <select name="language[{{ $language->id }}][read]">
                                    <option value="b" {{$language->pivot->read == 'b' ? 'selected' : ''}}>Beginner</option>
                                    <option value="i" {{$language->pivot->read == 'i' ? 'selected' : ''}}>Intermediate</option>
                                    <option value="e" {{$language->pivot->read == 'e' ? 'selected' : ''}}>Excellent</option>
                                </select>
                                <label>write</label>
                                <select name="language[{{ $language->id }}][write]">
                                    <option value="b" {{$language->pivot->write == 'b' ? 'selected' : ''}}>Beginner</option>
                                    <option value="i" {{$language->pivot->write == 'i' ? 'selected' : ''}}>Intermediate</option>
                                    <option value="e" {{$language->pivot->write == 'e' ? 'selected' : ''}}>Excellent</option>
                                </select>
                                <label>speak</label>
                                <select name="language[{{ $language->id }}][speak]">
                                    <option value="b" {{$language->pivot->speak == 'b' ? 'selected' : ''}}>Beginner</option>
                                    <option value="i" {{$language->pivot->speak == 'i' ? 'selected' : ''}}>Intermediate</option>
                                    <option value="e" {{$language->pivot->speak == 'e' ? 'selected' : ''}}>Excellent</option>
                                </select>
                            </div>
                        </div>
                        @if (!in_array(strtolower($language->name), ['hindi', 'english']))
                            <div class="col-md-1 text-center">
                                <button class="btn btn-danger btn-sm" onclick="remove_language({{ $language->id }})">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach