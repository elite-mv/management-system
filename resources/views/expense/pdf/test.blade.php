<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="mx-auto px-4 py-2" id="printable">

    <div class="d-flex mb-4">
        <div>
            <div class="border border-dark" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                <img src="./src/logos/PERSONAL_LOGO.png" class="img-fluid" alt="LOGO" style="height: 100px; width: auto;">
            </div>
            <div class="bg-red text-center text-white border border-dark" style="width: 100px; border-style: none solid none solid !important;">
                <strong>GTI</strong>
            </div>
        </div>

        <div style="font-size: 70px;" class="m-0 ms-2 px-5 border border-5 border-danger">
            <select id="requestStatus" class="w-100 h-100 border-0 outline-0 text-danger text-center">
                <option style="font-size: 20px" value="PENDING">PENDING</option>
                <option style="font-size: 20px" value="TO_RETURN">TO RETURN</option>
                <option style="font-size: 20px" value="HOLD">HOLD</option>
                <option style="font-size: 20px" value="TO_PROCESS">TO PROCESS</option>
                <option style="font-size: 20px" value="PROCESSING">PROCESSING</option>
                <option style="font-size: 20px" value="FOR_FUNDING">FOR FUNDING</option>
                <option style="font-size: 20px" value="RELEASED" selected="">RELEASED</option>
            </select>
        </div>

        <div class="ms-auto">
            <div class="bg-red text-center text-white border border-dark px-2" style="border-style: solid solid none solid !important;">
                <b>PAYMENT STATUS</b>
            </div>

            <div class="border border-dark" style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                <div class="w-100" style="display: flex; flex-direction: row;">
                    <div class="w-25 text-center border border-dark" style="border-style: none solid solid none !important;">
                        <input checked="" value="funded" class="fundStatus" type="checkbox" name="FUNDED" id="fundedStatus">
                    </div>
                    <div class="w-75 text-start border border-dark px-2" style="border-style: none none solid none !important;">
                        <small>FUNDED</small>
                    </div>
                </div>

                <div class="w-100" style="display: flex; flex-direction: row;">
                    <div class="w-25 text-center border border-dark" style="border-style: none solid none none !important;">
                        <input value="declined" class="fundStatus" type="checkbox" name="FUNDED" id="declinedStatus">
                    </div>
                    <div class="w-75 text-start border border-dark px-2" style="border-style: none none none none !important;">
                        <small>DECLINED</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="ms-2" style="width: 150px;">
            <div class="bg-red text-center text-white border border-dark px-2" style="border-style: solid solid none solid !important;">
                <b>STATUS</b>
            </div>
            <div class="border border-dark" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                <h1 class="text-danger">CLOSE</h1>
            </div>
        </div>

        <div class="ms-2">
            <div class="bg-red text-center text-white border border-dark px-2" style="border-style: solid solid none solid !important;">
                <b>REQUEST FORM NUMBER</b>
            </div>
            <div class="border border-dark" style="height: 100px; display: flex; align-items: center; justify-content: center;">
                <h1><b>001</b></h1>
            </div>
        </div>

    </div>

    <div class="mb-2 btn-group rounded w-100" role="group" aria-label="Basic outlined example">
        <a href="/expense/prev-request/1" role="button" class="btn btn-outline-dark">
            <i class="fas fa-arrow-left"></i>
        </a>
        <button type="button" class="btn btn-outline-dark" style="flex-basis:60%">20240903-001</button>
        <a href="/expense/next-request/1" role="button" class="btn btn-outline-dark">
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <table class="table table-bordered border-dark mx-auto">
        <tbody>
        <tr>
            <td colspan="4" class="small px-2">Date:</td>
            <td colspan="8" class="small px-2">2024-09-03 15:09</td>
            <td colspan="2" class="small px-2">CV NO:</td>
            <td colspan="4" class="small px-2">
                20240903-001
            </td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2">Supplier:</td>
            <td colspan="8" class="small px-2 text-capitalize">
                <small>[HIDDEN]</small>
            </td>
            <td colspan="2" class="small px-2">REF NO:</td>
            <td colspan="4" class="small px-2">20240903-001</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2">Paid to:</td>
            <td colspan="14" class="small px-2 text-capitalize">Amira Hammes</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2">Requested By:</td>
            <td colspan="14" class="small px-2 text-capitalize">Lilla Bosco</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2">Prepared By:</td>
            <td colspan="14" class="small px-2 text-capitalize">[DEVELOPER]</td>
        </tr>
        <tr>
            <td class="small text-center bg-dark text-white" colspan="18">EXPENSE REQUEST</td>
        </tr>
        <tr>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">QTY</td>
            <td colspan="3" class="small text-center fw-bold bg-gray text-uppercase">UOM</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">JOB ORDER</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">DESCRIPTION</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">UNIT COST</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">TOTAL</td>
            <td colspan="3" class="small text-center fw-bold bg-gray text-uppercase">STATUS</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">REMARKS</td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">1637537024</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Recusandae sunt sit iusto ex et quod voluptate. Nostrum occaecati porro dolor incidunt in nesciunt. Soluta doloremque minima enim sed. Ut iste quia excepturi perferendis natus et rerum.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱977.46</td>
            <td colspan="2" class="small px-2 bg-transparent">₱1,600,626,939,479.04</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">1551995025</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Modi vero sunt voluptas veritatis molestiae repellat. Iste ab voluptatem sint modi ut iusto quia. Enim ut fuga adipisci est.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱633.19</td>
            <td colspan="2" class="small px-2 bg-transparent">₱982,707,729,879.75</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">995779339</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Cumque perferendis vero ut nulla consequatur. Quaerat aut ut consequatur laudantium aut et et. Quibusdam ipsam ut incidunt sunt odit in.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱725.90</td>
            <td colspan="2" class="small px-2 bg-transparent">₱722,836,222,180.10</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">1503491463</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Id animi facere odio nostrum necessitatibus. Asperiores animi voluptas velit laboriosam. Voluptas quae modi odit autem voluptatem velit.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱336.32</td>
            <td colspan="2" class="small px-2 bg-transparent">₱505,654,248,836.16</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">1959224810</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Sint illum a a explicabo. Architecto et et odit atque veritatis facere. Voluptatem doloremque cumque ut. Debitis architecto ea quisquam excepturi. Sit rem molestiae illum similique facere.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱145.25</td>
            <td colspan="2" class="small px-2 bg-transparent">₱284,577,403,652.50</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">834418930</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Ipsa atque officia quia laudantium accusantium quae quisquam. Quae qui eum quis quod laudantium. Possimus eveniet hic placeat et animi recusandae assumenda id.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱513.59</td>
            <td colspan="2" class="small px-2 bg-transparent">₱428,549,218,258.70</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">861700910</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Natus illo quidem est qui et ad. Deserunt odit assumenda nemo aperiam sit. Sit ducimus animi blanditiis odit reiciendis distinctio.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱505.31</td>
            <td colspan="2" class="small px-2 bg-transparent">₱435,426,086,832.10</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">1460321181</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Adipisci dolor dolor est sed nam. Doloribus deserunt ut sunt et. Qui voluptates modi voluptatem quo debitis ut repudiandae aut.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱487.80</td>
            <td colspan="2" class="small px-2 bg-transparent">₱712,344,672,091.80</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">1308237650</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Tenetur omnis quisquam officiis placeat laboriosam nulla consequatur. Eveniet aut impedit sit est. Vero debitis quae soluta qui tempora quasi. Consequatur eos sit inventore et fugit ratione qui.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱646.83</td>
            <td colspan="2" class="small px-2 bg-transparent">₱846,207,359,149.50</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr class="selectable" role="button">
            <td colspan="2" class="small px-2 bg-transparent text-transparent">169489642</td>
            <td colspan="3" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="2" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="2" class="small bg-transparent">
                <div class="d-flex align-items-center bg-transparent">
                    <p class="m-0 p-0 text-ellipsis" style="max-width: 45ch">Nesciunt rerum tempora sit at quia sed eligendi. Voluptatibus dolorem ad fugit iusto. Repellendus voluptas nesciunt quia iste at exercitationem optio. Nostrum labore quis repudiandae et.</p>
                </div>
            </td>
            <td colspan="2" class="small px-2 bg-transparent">₱919.60</td>
            <td colspan="2" class="small px-2 bg-transparent">₱155,862,674,783.20</td>
            <td colspan="3" class="small px-2 bg-transparent">PRIORITY</td>
            <td colspan="2" class="small px-2 bg-transparent"></td>
        </tr>
        <tr>
            <td colspan="9" class="px-2 small text-end fw-bold bg-gray text-uppercase">TOTAL</td>
            <td colspan="4" class="px-2 small text-end">₱6,674,792,555,142.85</td>
            <td colspan="5" class="px-2 small text-center fw-bold bg-gray text-uppercase">₱6,674,792,555,142.85</td>
        </tr>
        <tr>
            <td class="small text-center bg-dark text-white" colspan="18">PURCHASE REQUEST</td>
        </tr>
        <tr>
            <td colspan="4" class="px-2 small bg-gray">Supplier</td>
            <td colspan="5" class="px-2 small">
                <small>[HIDDEN]</small>
            </td>
            <td colspan="3" class="px-2 small bg-gray">Payment Type</td>
            <td colspan="6" class="px-2 small">
                GCASH
            </td>
        </tr>

        <tr>
            <td colspan="4" class="small bg-yellow text-center fw-bold" style="width: 179px">QTY</td>
            <td colspan="4" class="small bg-yellow text-center fw-bold" style="width: 179px">UOM</td>
            <td colspan="1" class="small bg-yellow text-center fw-bold" style="width: 179px">JOB ORDER
            </td>
            <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">
                DESCRIPTION
            </td>
            <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">UNIT COST
            </td>
            <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">TOTAL</td>
        </tr>

        <tr>
            <td colspan="4" class="small px-2 bg-transparent">1637537024</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Recusandae sunt sit iusto ex et quod voluptate. Nostrum occaecati porro dolor incidunt in nesciunt. Soluta doloremque minima enim sed. Ut iste quia excepturi perferendis natus et rerum.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱977.46</td>
            <td colspan="3" class="small px-2 bg-transparent">₱1,600,626,939,479.04</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">1551995025</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Modi vero sunt voluptas veritatis molestiae repellat. Iste ab voluptatem sint modi ut iusto quia. Enim ut fuga adipisci est.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱633.19</td>
            <td colspan="3" class="small px-2 bg-transparent">₱982,707,729,879.75</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">995779339</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Cumque perferendis vero ut nulla consequatur. Quaerat aut ut consequatur laudantium aut et et. Quibusdam ipsam ut incidunt sunt odit in.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱725.90</td>
            <td colspan="3" class="small px-2 bg-transparent">₱722,836,222,180.10</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">1503491463</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Id animi facere odio nostrum necessitatibus. Asperiores animi voluptas velit laboriosam. Voluptas quae modi odit autem voluptatem velit.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱336.32</td>
            <td colspan="3" class="small px-2 bg-transparent">₱505,654,248,836.16</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">1959224810</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Sint illum a a explicabo. Architecto et et odit atque veritatis facere. Voluptatem doloremque cumque ut. Debitis architecto ea quisquam excepturi. Sit rem molestiae illum similique facere.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱145.25</td>
            <td colspan="3" class="small px-2 bg-transparent">₱284,577,403,652.50</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">834418930</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Ipsa atque officia quia laudantium accusantium quae quisquam. Quae qui eum quis quod laudantium. Possimus eveniet hic placeat et animi recusandae assumenda id.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱513.59</td>
            <td colspan="3" class="small px-2 bg-transparent">₱428,549,218,258.70</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">861700910</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Natus illo quidem est qui et ad. Deserunt odit assumenda nemo aperiam sit. Sit ducimus animi blanditiis odit reiciendis distinctio.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱505.31</td>
            <td colspan="3" class="small px-2 bg-transparent">₱435,426,086,832.10</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">1460321181</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Adipisci dolor dolor est sed nam. Doloribus deserunt ut sunt et. Qui voluptates modi voluptatem quo debitis ut repudiandae aut.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱487.80</td>
            <td colspan="3" class="small px-2 bg-transparent">₱712,344,672,091.80</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">1308237650</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Tenetur omnis quisquam officiis placeat laboriosam nulla consequatur. Eveniet aut impedit sit est. Vero debitis quae soluta qui tempora quasi. Consequatur eos sit inventore et fugit ratione qui.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱646.83</td>
            <td colspan="3" class="small px-2 bg-transparent">₱846,207,359,149.50</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 bg-transparent">169489642</td>
            <td colspan="4" class="small px-2 bg-transparent">PIECE/S</td>
            <td colspan="1" class="small px-2 bg-transparent">VARIOUS VEHICLES</td>
            <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                <p class="m-0 p-0 text-truncate">Nesciunt rerum tempora sit at quia sed eligendi. Voluptatibus dolorem ad fugit iusto. Repellendus voluptas nesciunt quia iste at exercitationem optio. Nostrum labore quis repudiandae et.</p>
            </td>
            <td colspan="3" class="small px-2 bg-transparent">₱919.60</td>
            <td colspan="3" class="small px-2 bg-transparent">₱155,862,674,783.20</td>
        </tr>
        <tr>
            <td colspan="15" class="px-2 small bg-yellow text-end fw-bold">TOTAL</td>
            <td colspan="3" class="px-2 small bg-yellow text-center fw-bold">₱6,674,792,555,142.85</td>
        </tr>
        <tr>
            <td class="small text-center bg-dark text-white" colspan="18">VOUCHER</td>
        </tr>
        <tr>
            <td colspan="4" class="px-2 small fw-bold bg-gray">Supplier:</td>
            <td colspan="5" class="px-2 small">
                <small>[HIDDEN]</small>
            </td>
            <td colspan="3" class="px-2 small fw-bold bg-gray">Date:</td>
            <td colspan="6" class="px-2 small">
                2024-09-03 15:09
            </td>
        </tr>
        <tr>
            <td colspan="4" class="px-2 small fw-bold bg-gray">Paid to:</td>
            <td colspan="5" class="px-2 small">
                <small>[HIDDEN]</small>
            </td>
            <td colspan="3" class="px-2 small fw-bold bg-gray">Paid amount:</td>
            <td colspan="6" class="px-2 small">
                ₱6,674,792,555,142.85
            </td>
        </tr>
        <tr>
            <td colspan="4" class="px-2 small fw-bold bg-gray">Payment Type:</td>
            <td colspan="5" class="px-2 small">
                GCASH
            </td>
            <td colspan="3" class="px-2 small fw-bold bg-gray">Amount in words:</td>
            <td colspan="6" class="px-2 small">
                SIX TRILLION SIX HUNDRED SEVENTY FOUR BILLION SEVEN HUNDRED NINETY TWO MILLION FIVE HUNDRED FIFTY FIVE THOUSAND ONE HUNDRED  FORTY TWO AND EIGHT CENTAVOS ONLY
            </td>
        </tr>
        <tr>
            <td colspan="8" class="bg-yellow text-center small" style="width: 367px">RELEASED BY :</td>
            <td colspan="4" class="bg-red text-center small" style="width: 367px">RECEIVED BY :</td>
            <td colspan="6" class="bg-green text-center small" style="width: 367px">AUDITED BY :</td>
        </tr>
        <tr style="height: 80px">
            <td colspan="8" class="text-center align-bottom fw-bold small" style="height: 24px">
                <input readonly="" value="mr. rylan c. alingarog" class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">

            </td>
            <td colspan="4" class="text-center align-bottom fw-bold small" style="height: 24px">
                <input value="what the" id="receivedBy" class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">
            </td>
            <td colspan="6" class="text-center align-bottom fw-bold small" style="height: 24px">
                <input value="Jocelyn" id="auditedBy" class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">
            </td>
        </tr>

        <tr>
            <td colspan="8" class="small bg-yellow text-center">Signature Over Printed Name</td>
            <td colspan="4" class="small bg-red text-center">Signature Over Printed Name</td>
            <td colspan="6" class="small bg-green text-center">Signature Over Printed Name</td>
        </tr>
        <tr>
            <td class="text-center bg-dark text-white" colspan="18" style="height: 24px">
            </td>
        </tr>
        <tr>
            <td colspan="9" class="text-center fw-bold py-2">ACCOUNTING DEPARTMENT</td>
            <td colspan="9" class="text-center fw-bold py-2">AUDITOR DEPARTMENT</td>
        </tr>
        <tr>
            <td colspan="4" class="text-center fw-bold bg-red small" style="width: 171px">Priority
                level
            </td>
            <td colspan="4" class="text-center fw-bold bg-blue small">Type</td>
            <td colspan="1" class="text-center fw-bold bg-blue small">BANK NAME</td>
            <td colspan="4" class="fw-bold small px-2">ITEMS DELIVERY</td>
            <td colspan="5" class="px-2 fw-bold small bg-blue" style="width: 268px">BOOK KEEPER</td>
        </tr>
        <tr>
            <td colspan="1" class="text-center" style="width: 32px">
                <input class="priorityLevel" value="LOW" type="checkbox" name="LOW">
            </td>
            <td colspan="2" class="small px-2">Low</td>
            <td colspan="1" class="small px-2">5 days</td>
            <td colspan="1" class="text-center" style="width: 32px">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable" style="width: 146px">
                Advertising/Promotional
            </td>
            <td colspan="1">
                AUB
            </td>
            <td colspan="1" class="text-center" style="width: 32px">
                <input value="1" class="deliveryStatus" name="requestDeliveryStatus" id="requestDeliveryComplete" type="checkbox" checked="">

            </td>
            <td colspan="3" class="px-2 bg-green small">Complete</td>
            <td colspan="5" class="px-2 small selectable">
                APPROVED
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input class="priorityLevel" value="MEDIUM" type="checkbox" name="MEDIUM">
            </td>
            <td colspan="2" class="small px-2">Medium</td>
            <td colspan="1" class="small px-2">3 days</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="1" class="text-center fw-bold bg-blue small">BANK CODE</td>
            <td colspan="1" class="text-center">
                <input value="0" class="deliveryStatus" name="requestDeliveryStatus" id="requestDeliveryIncomplete" type="checkbox">
            </td>
            <td colspan="3" class="px-2 bg-blue small">Incomplete</td>
            <td colspan="5" class="px-2 small">
                2024-09-03 15:09
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input class="priorityLevel" value="HIGH" type="checkbox" name="HIGH" checked="">
            </td>
            <td colspan="2" class="small px-2">High</td>
            <td colspan="1" class="small px-2">1 day</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">
                Other costs of sales
            </td>
            <td colspan="1">
                AUB-Ballistic-0494
            </td>
            <td colspan="4" class="fw-bold small px-2"> SUPPLIER VERIFICATION</td>
            <td colspan="5" class="fw-bold px-2 small bg-blue">ACCOUNTANT</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 fw-bold bg-red text-center">Attachment</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="1" class="bg-blue fw-bold text-center small">CHECK NUMBER</td>
            <td colspan="1" class="text-center">
                <input value="1" class="deliverySupplier" type="checkbox" checked="">
            </td>
            <td colspan="3" class="small px-2">Yes</td>
            <td colspan="5" class="small px-2 selectable">
                APPROVED
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="WITH" class="attachment" type="checkbox">
            </td>
            <td colspan="3" class="small px-2">With</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="1">
                12e12
            </td>
            <td colspan="1" class="text-center">
                <input value="0" class="deliverySupplier" type="checkbox">
            </td>
            <td colspan="3" class="small px-2">No</td>
            <td colspan="5" class="small px-2">
                24-09-03 15:09
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="WITHOUT" class="attachment" type="checkbox" checked="">
            </td>
            <td colspan="3" class="small px-2">Without</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="1" rowspan="7"></td>
            <td colspan="4" class="text-center fw-bold small">VAT INPUT AMOUNT</td>
            <td colspan="5" class="px-2 small fw-bold bg-blue">FINANCE</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 text-center bg-red fw-bold">Type</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="4" class="text-center small px-2">
                <input type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
            </td>
            <td colspan="5" class="small px-2 selectable">
                APPROVED
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="OPEX" class="attachmentType" type="checkbox" checked="">
            </td>
            <td colspan="3" class="small px-2">OPEX</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="4" class="text-center small px-2">
                <input type="text" id="vatOption2" class="h-100 w-100 border-0 outline-0">
            </td>
            <td colspan="5" class="small px-2">
                24-09-03 15:09
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="NON_OPEX" class="attachmentType" type="checkbox">
            </td>
            <td colspan="3" class="small px-2">NON OPEX</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td><td colspan="2" class="small px-2 fw-bold">PO No.</td>
            <td colspan="2" class="small px-2">
                <input id="purchaseOrderInput" class="w-100 border-0 outline-0">
            </td>
            <td colspan="5" class="small px-2 fw-bold bg-blue">AUDITOR</td>
        </tr>
        <tr>
            <td colspan="4" class="small px-2 text-center bg-red fw-bold">Receipt</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">

            </td>
            <td colspan="2" class="small px-2 fw-bold">Invoice No</td>
            <td colspan="2" class="small px-2">
                <input id="invoiceNumberInput" class="w-100 border-0 outline-0">
            </td>
            <td colspan="5" class="small px-2 selectable">
                APPROVED
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="OFFICIAL_RECEIPT_VAT" class="attachmentReceipt" type="checkbox" checked="">
            </td>
            <td colspan="3" class="small px-2">Official Receipt VAT</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">
            </td>
            <td colspan="2" class="fw-bold small px-2">Bill No.</td>
            <td colspan="2" class="small px-2">
                <input id="billNumberInput" class="w-100 border-0 outline-0">
            </td>
            <td colspan="5" class="small px-2">
                2024-09-03 15:09
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="DELIVERY_RECEIPT" class="attachmentReceipt" type="checkbox">
            </td>
            <td colspan="3" class="small px-2">Delivery Receipt</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 selectable">
            </td>
            <td colspan="2" class="fw-bold small px-2">OR No</td>
            <td colspan="2" class="small px-2">
                <input id="orNumberInput" class="w-100 border-0 outline-0">
            </td>
            <td colspan="4" rowspan="2" class="small px-2" style="width: 171px"></td>
            <td colspan="1" rowspan="2" class="text-center fw-bold align-middle">
                RCA
            </td>
        </tr>
        <tr>
            <td colspan="1" class="text-center">
                <input value="NONE" class="attachmentReceipt" type="checkbox">
            </td>
            <td colspan="3" class="small px-2">None</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="4" class="px-2">
                <div class="d-flex gap-1 align-items-center mb-1">
                    <label class="small">Others:</label>
                    <input class="small w-100 outline-0 border-1 border-top-0 border-start-0 border-end-0">
                </div>
            </td>
            <td colspan="2" class="fw-bold small px-2">Voucher No</td>
            <td colspan="2" class="small px-2">
                001
            </td>
        </tr>
        <tr>
            <td class="text-center bg-dark text-white" colspan="18" style="height: 24px"></td>
        </tr>
        </tbody>
    </table>
</div>
