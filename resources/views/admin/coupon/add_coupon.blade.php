@extends('admin.layouts.master')

@section('title', 'Coupons Add')

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-gift"></i>
        </div>
        <div class="header-title">
            <h1>Add Coupons</h1>
            <small>Coupons list</small>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group" id="buttonlist">
                            <a class="btn btn-add " href="{{ route('coupons.view') }}">
                                <i class="fa fa-list"></i> Coupons List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('categories.store') }}" method="POST" class="col-sm-12"
                            id="categoryAddForm">
                            @csrf
                            <div class="form-group col-sm-6">
                                <label>Coupon Code</label>
                                <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code">
                                <span
                                    class="text-danger">{{ (@$errors->has('coupon_code'))? @$errors->first('coupon_code') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount</label>
                                <input type="text" name="amount" class="form-control" placeholder="Amount">
                                <span
                                    class="text-danger">{{ (@$errors->has('amount'))? @$errors->first('amount') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Amount Type</label>
                                <select name="amount_type" id="amount_type" class="form-control">
                                    <option value="" selected>Select Type</option>
                                    <option value="Percentange">Percentage</option>
                                    <option value="Fixed">Fixed</option>
                                </select>
                                <span
                                    class="text-danger">{{ (@$errors->has('amount_type'))? @$errors->first('amount_type') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Expiry Date</label>
                                <input type="text" name="expiry_date" class="form-control" id="datepicker"
                                    autocomplete="off">
                                <span
                                    class="text-danger">{{ (@$errors->has('expiry_date'))? @$errors->first('expiry_date') : '' }}</span>
                            </div>
                            <div class="form-group col-sm-6" style="margin-top: 25px;">
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script>
    $(function(){
        $("#categoryAddForm").validate({
            rules: {
                name: "required",
                description: "required",
            },
            messages: {
                name: "Please enter category name",
                description: "Please enter category description",
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<style>
    .error {
        color: red;
        font-weight: bold;
    }
</style>
@endsection