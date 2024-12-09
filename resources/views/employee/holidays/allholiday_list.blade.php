<div class="card p-5 pt-4" id="holiday_list">
    <h4 class="holiday_header">Holiday List</h4>
    <div class="row">
        @forelse ($allHolidayDetails as $holdays)
            <div class="col-md-4">
                <div class="holiday_list">
                    <h2>{{ $holdays->name }}</h2>
                    <span>{{ getFormattedDate($holdays->date) }}</span>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-md-12">
                    <h6>Holiday Not Found!</h6>
                </div>
            </div>
        @endforelse
    </div>
</div>
