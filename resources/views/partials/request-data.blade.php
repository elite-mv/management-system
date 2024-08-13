@forelse ($requests as $request)
<tr class="item">
    <td>{{ $request->reference}}</td>
    <td>{{ $request->amount}}</td>
    <td>{{ $request->company->name}}</td>
    <td>{{ $request->request_by}}</td>
    <td>{{ $request->status}}</td>
    <td>{{ $request->total}}</td>
    <td>
        <a role="button" href="google.com" class="btn btn-primary">View</a>
    </td>
</tr>
@empty
<tr >
    <td class="text-center" colspan='7'>
        <p class="text-secondary">
        EMPTY TABLE
        </p>
    </td>
</tr>
@endforelse