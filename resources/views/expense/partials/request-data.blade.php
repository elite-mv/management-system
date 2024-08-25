



@forelse ($requests as $request)
    <tr>
        <td><input id="requestInput{{$request->id}}" type="checkbox"
                   class="form-check-input request-input-selection">
        </td>
        <td>{{ $request->reference}}</td>
        <td>{{$request->timeLapse}}</td>
        <td>{{ $request->company->name}}</td>
        <td>{{ $request->request_by}}</td>
        <td>{{ $request->status}}</td>
        <td>{!! \App\Helper\Helper::formatPeso( $request->total) !!}</td>
        <td>
            <a target="_blank role=" role="button" href="/expense/request/{{$request->id}}" class="btn btn-primary">View</a>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan='7'>
            <p class="text-secondary">
                EMPTY TABLE
            </p>
        </td>
    </tr>
@endforelse

<tr>
    <td colspan="9">
        {{ $requests->links()}}
    </td>
</tr>
