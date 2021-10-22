<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Lịch sử sử dụng giảm giá</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
        <div class="modal-body">
            <table class="table table-sm">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Thời gian</th>
                    <th>Khách hàng</th>
                    <th>Tiền đơn</th>
                    <th>Tiền giảm</th>
                </tr>
                </thead>
                <tbody>
                @forelse($invoices as $index => $invoice)
                <tr>
                    <th scope="row">{{ $index+1 }}</th>
                    <td>{{ $invoice->paid_at->format(config('app.date_time_format')) }}</td>
                    <td><a href="{{ route('admin.users.index', ['id'=> $invoice->user->id]) }}" target="_blank">{{ $invoice->user->name }}</a></td>
                    <td>{{ number($invoice->subtotal) }}</td>
                    <td>{{ number($invoice->discount) }}</td>
                </tr>
                @empty
                    <tr>
                        <th scope="row" colspan="5">Chưa có hoá đơn nào</th>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>

	</div>
</div>
