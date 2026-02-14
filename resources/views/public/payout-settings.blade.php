@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
            @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Payout Settings</h2>
                <form id="updatePay-settings">
                    <div class="row">
                        @csrf
                        @if($pay_settings)
                        <input type="number" name="pay_id" hidden value="{{$pay_settings->id}}">
                        @endif
                        <input type="text" name="user" hidden value="{{Session::get('user_id')}}">
                        <div class="col-md-6 mb-3">
                            <label for="">Bank Name</label>
                            <input type="text" name="bank_name" class="form-control" value="{{$pay_settings?->bank_name}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Account No.</label>
                            <input type="number" name="account_no" class="form-control" value="{{$pay_settings?->account_no}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">IBAN</label>
                            <input type="text" name="iban" class="form-control" value="{{$pay_settings?->iban}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Bank Address</label>
                            <input type="text" name="bank_address" class="form-control" value="{{$pay_settings?->bank_address}}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary link-btn">Update</button>
                        </div>
                        <div class="col-md-12">
                            <div class="message"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('public/layout/footer')