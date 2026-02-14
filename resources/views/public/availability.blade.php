@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Availability</h2>
                <div class="row border pt-2 mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="checkbox" class="checkAllday" name="day_all" value="all">    
                            <label for="">All Days</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">From Time</label>
                            <input type="time" class="form-control" name="from_time_all" value="00:00">    
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">To Time</label>
                            <input type="time" class="form-control" name="to_time_all" value="23:00">    
                        </div>
                    </div>
                </div>
                @php
                    $days_list = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
                    $selected_days = [];
                    @endphp
                 
                @if($availability->isNotEmpty())
                @foreach($availability as $avail)
                    @php array_push($selected_days,$avail->day); @endphp
                @endforeach
                 
                @endif
                @foreach($days_list as $key=>$day)
                    
                    <div class="row border pt-2 mb-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                @php $checked = in_array($key+1,$selected_days) ? 'checked' : '';  @endphp
                                <input type="checkbox" class="daycheck" name="day[]" {{$checked}} value="{{$key+1}}">    
                                <label for="">{{$day}}</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">From Time</label>
                                @if($checked != '')
                                    @foreach($availability as $avl)
                                    @if($avl->day == $key+1)
                                        @php $from_time = $avl->from_time;   @endphp
                                    @endif
                                    @endforeach
                                @else
                                    @php $from_time = '00:00';   @endphp
                                @endif
                                <input type="time" class="form-control from-time" name="from_time[{{$key+1}}]" value="{{$from_time}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">To Time</label>
                                @if($checked != '')
                                    @foreach($availability as $avl)
                                    @if($avl->day == $key+1)
                                        @php $to_time = $avl->to_time;   @endphp
                                    @endif
                                    @endforeach
                                @else
                                    @php $to_time = '23:00';   @endphp
                                @endif
                                <input type="time" class="form-control to-time" name="to_time[{{$key+1}}]" value="{{$to_time}}">    
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn link-btn save-availability">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')