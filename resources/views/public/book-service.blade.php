@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Book Service</h2>
                <form id="submit-service" method="POST">
                    @csrf
                    <table class="table bg-white">
                        <tr>
                            <td>Service Name</td>
                            <td>{{$service->service_name}}</td></td>
                        </tr>
                        <tr>
                            <td>Service Category</td>
                            <td>{{$service->category_name}}</td></td>
                        </tr>
                        <tr>
                            <td>Service Amount</td>
                            <td>{{$siteInfo->cur_format}}{{$service->service_amount}}</td></td>
                        </tr>
                        <tr>
                            <td>Service Location</td>
                            <td>
                                <select name="location" class="form-control">
                                    @foreach($locations as $location)
                                        @php $selected = ($location->city_id == $service->locaation) ? 'selected' : '';  @endphp
                                        <option value="{{$location->city_id}}" {{$selected}}>{{$location->city_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><input type="date" class="form-control" name="date" value="@php echo date('Y-m-d');  @endphp"></td></td>
                        </tr>
                    </table>
                    <div class="row">
                        <input type="text" name="service" hidden value="{{$service->service_id}}">
                        <input type="text" name="provider" hidden value="{{$service->provider}}"> 
                        @if($wallet && $wallet > 0 && $wallet >= $service->service_amount)
                        <input type="submit" class="btn btn-primary link-btn" value="Continue to Book" name="submit">
                        @else
                            <h6 class="m-0 ml-3 text-danger">Insufficent Wallet Balance. Add Balance in Wallet to book this service.</h6>
                        @endif
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')