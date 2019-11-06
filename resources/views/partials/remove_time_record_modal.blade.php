<div class="modal fade" id="removeTimeRecordModal" tabindex="-1" role="dialog"
     aria-labelledby="removeTimeRecordModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('process-remove-time-record-form') }}">
                @csrf
                <input id="remove_time_record_modal_id" type="hidden" name="modal_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeTimeRecordModalLabel">Remove time record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to do it?</h4>
                    <p>The time record cannot be recovered once it has been deleted</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Remove time record</button>
                </div>
            </form>
        </div>
    </div>
</div>
