
<div class="row g-4 mb-3">
    <div class="col-sm-auto">
        <div>
            {{ $tools }}
        </div>
    </div>
 
</div>
    <table class="table-responsive table table-striped table-bordered table-hover dataTables-example" >
        <thead class="table-light">
            <tr>
               {{ $thead }}
            </tr>
        </thead>
        <tbody >
            {{ $tbody }}
        </tbody>
        <tfoot class="table-light">
            <tr>
                {{ $thead }}
            </tr>
        </tfoot>
    </table>

