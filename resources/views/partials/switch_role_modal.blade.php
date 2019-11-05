<div class="modal fade" id="switchRoleModal" tabindex="-1" role="dialog" aria-labelledby="switchRoleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('process-toogle-role-form') }}">
                @csrf
                <input id="switch_role_modal_user_id" type="hidden" name="user_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="switchRoleModalLabel">Change role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="switch_role_modal_is_admin"
                               name="is_admin">
                        <label class="form-check-label" for="switch_role_modal_is_admin">
                            {{ __('Is admin?') }}
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update status</button>
                </div>
            </form>
        </div>
    </div>
</div>
