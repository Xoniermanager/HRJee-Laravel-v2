<div class="card p-5" id="holiday_list">
    <h4>Holiday List</h4>
    @forelse ($allHolidayDetails as $holdays)
    <div class="row">
        <div class="col-md-6">{{ $holdays->name }}</div>
        <div class="col-md-6">{{date('Y-M-d',strtotime($holdays->date))}}</div>
    </div>
    @empty
        <div class="row">
            <div class="col-md-12">
                <h6>Holiday Not Found!</h6>
            </div>
        </div>
    @endforelse

</div>
