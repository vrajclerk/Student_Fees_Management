<form method="GET" action="{{ route('students.index') }}" class="float-center">
    
    <div class="form-group ">
        {{-- <label for="payment_status">Filter by Fees Status</label> --}}
        <select name="payment_status" id="payment_status" class="$form-select-feedback-icon-size:        $input-height-inner-half $input-height-inner-half; ">
            <option value=""> Select Fees Status </option>
            <option value="fully_paid">Fully Paid</option>                                                                      
            <option value="partially_paid">Partially Paid</option>
            <option value="not_paid">Not Paid</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
   
</form>