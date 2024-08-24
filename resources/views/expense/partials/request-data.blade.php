<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 text-start">
                    <i class="fas fa-table me-1"></i>
                    <b>Requests</b>
                </div>
                <div class="col-6 text-end">
                    <b>Total: {!! \App\Helper\Helper::formatPeso($total) !!}</b>
                </div>
            </div>
        </div>
        <div class="card-body overflow-x-auto" >
            <table class="table sortable" id="sortableTable">

                <thead>
                <tr>
                    <th class="sorttable_nosort">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="requestAllInput">
                        </div>
                    </th>
                    <th>REFERENCE</th>
                    <th>DURATION</th>
                    <th>ENTITY</th>
                    <th>REQUESTED BY</th>
                    <th>STATUS</th>
                    <th>TOTAL</th>
                    <th>ACTION</th>
                </tr>
                </thead>

                <tbody>


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
                </tbody>
            </table>
        </div>

        <div class="container-fluid">
            {{ $requests->links()}}
        </div>
    </div>
</div>



