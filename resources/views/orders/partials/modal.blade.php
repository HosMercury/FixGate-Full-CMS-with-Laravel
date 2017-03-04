<div class="modal fade" id="rateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mission Completed Form</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="/orders/{{$order->id}}/close">
                    {{csrf_field()}}
                    <div class="form-group  {{ $errors->has('rating') ? ' has-error' : '' }}">
                        <label for="rating">Please Rate this service* </label>

                        <div id="rating" class="form-group">
                            <input type="radio" name="rating" class="rating" value="1"/>
                            <input type="radio" name="rating" class="rating" value="2"/>
                            <input type="radio" name="rating" class="rating" value="3"/>
                            <input type="radio" name="rating" class="rating" value="4"/>
                            <input type="radio" name="rating" class="rating" value="5"/>
                        </div>
                        @if ($errors->has('rating'))
                            <span class="help-block">
                            <strong>{{ $errors->first('rating') }}</strong>
                        </span>
                        @endif
                    </div>

                    <hr>
                    <div class="form-group col-sm-6 pull-left {{ $errors->has('closekey') ? ' has-error' : '' }}">
                        <label for="closekey">Close Key*</label>
                        <input type="text" class="form-control" id="closekey" aria-describedby="closekey"
                               name="closekey" placeholder="Close Key">
                        <small id="" class="form-text text-muted">This key belongs only to all persons belong
                            to that location .
                        </small>
                        @if ($errors->has('closekey'))
                            <span class="help-block has-error">
                                <strong>{{ $errors->first('closekey') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-sm-6 {{ $errors->has('feedback') ? ' has-error' : '' }}">
                        <div class="">
                            <label>Feedback</label>
                        </div>
                        <textarea type="text" rows="2" class="form-control" id="feedback" aria-describedby="feedback"
                                  name="feedback" placeholder="feedback"></textarea>
                        </small>
                        @if ($errors->has('feedback'))
                            <span class="help-block has-error">
                                <strong>{{ $errors->first('feedback') }}</strong>
                            </span>
                        @endif
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Close this order</button>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
