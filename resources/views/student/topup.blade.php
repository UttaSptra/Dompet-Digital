<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topupModalLabel">Top Up Saldo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student.topup') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="amount" class="form-label">Jumlah Top Up</label>
                        <input type="number" class="form-control" name="amount" min="1000" required>
                    </div>
                    <button type="submit" class="btn btn-success">Top Up</button>
                </form>
            </div>
        </div>
    </div>
</div>
