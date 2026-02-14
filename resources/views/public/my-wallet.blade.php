@include('public/layout/header')
<div id="main-content" class="py-5">
    <div class="container">
        <div class="row">
        @include('public/profile-sidebar')
            <div class="col-lg-9 col-md-8">
                <h2 class="section-head mb-4">Wallet</h2>
                @if(Session::has('success'))
                    <p class="alert alert-success">{{Session::get('success')}}</p>
                @endif
                @if(Session::has('error'))
                    <p class="alert alert-danger">{{Session::get('error')}}</p>
                @endif
                <div class="row mb-4">
                    <div class="col-md-6 col-12">
                        <div>
                            <h4>Balance</h4>
                            <h5>{{$siteInfo->cur_format}}{{$wallet->balance}}</h5>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        @if(session::get('user_type') == 'user')
                        <h4>Add Amount</h4>
                        <form id="add-payment-wallet" method="POST">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rs.</span>
                                </div>
                                <input type="number" class="form-control" name="amount" placeholder="00.00"  aria-describedby="basic-addon1" required>
                                <input type="text" hidden name="user" value="{{Session::get('user_id')}}">
                            </div>
                            <small class="mb-3 d-block">Minimum Add Amount {{$siteInfo->cur_format}}{{$siteInfo->min_add_amount}}</small>
                            <ul class="list-group mb-3">
                                @if(in_array('Paypal',$pay_methods))
                                <li class="list-group-item">
                                    <input type="radio" name="pay_method" value="paypal" required>
                                    <img src="{{asset('public/images/paypal.png')}}" alt="" height="20px">
                                </li>
                                @endif
                                @if(in_array('Razorpay',$pay_methods))
                                <li class="list-group-item">
                                    <input type="radio" name="pay_method" value="razorpay" required>
                                    <img src="{{asset('public/images/razorpay.png')}}" alt="" height="20px">
                                    <input type="text" hidden name="razor_key" value="{{env('RAZORPAY_KEY')}}">
                                </li>
                                @endif
                            </ul>
                            <input type="text" hidden name="min_add" value="10">
                            <button type="submit" class="btn link-btn">Add Amount</button>
                            <div class="message mt-3 mb-0">
                            </div>
                        </form>
                        @else
                        <h4>Withdraw Amount</h4>
                        <form  id="withdraw-wallet">
                            @csrf
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rs.</span>
                                </div>
                                <input type="number" class="form-control" name="amount" placeholder="00.00"  aria-describedby="basic-addon1" min="{{$siteInfo->min_add_amount}}" required>
                                <input type="text" hidden name="user" value="{{Session::get('user_id')}}">
                            </div>
                            <small class="mb-3 d-block">Minimum Withdraw Amount {{$siteInfo->cur_format}}{{$siteInfo->min_add_amount}}</small>
                            <button class="btn link-btn">Withdraw Amount</button>
                        </form>
                        @endif
                    </div>
                </div>
                <h2 class="section-head mb-4">Recent Transactions</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Date</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Reason</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transactions->isNotEmpty())
                        @php $i=0; @endphp
                        @foreach($transactions as $row)
                        @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{date('d M, Y',strtotime($row->created_at))}}</td>
                                @if($row->type == 'credit')
                                    <td>{{$row->amount}}</td>
                                    <td></td>
                                @else
                                    <td></td>
                                    <td>{{$row->amount}}</td>
                                @endif
                                <td>{{$row->reason}}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="5" align="center">No Record Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('public/layout/footer')