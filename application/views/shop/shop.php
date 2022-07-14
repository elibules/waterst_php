<h1 class="pageHeader">Products</h1>
<div class="shopWrapper">
    <div class="shopFilters">
        <form action="<?= site_url() ?>/shop/filter" method="get" id="filters">
            <h5>Format</h5>
            <div class="inputLabel">
                <input type="checkbox" name="f-CD" value="f-CD" id="f-CD" class="filterInput">
                <label for="f-CD">CD</label>
            </div>
            <div class="inputLabel">
                <input type="checkbox" name="f-Vinyl" value="f-Vinyl" id="f-Vinyl" class="filterInput">
                <label for="f-Vinyl">Vinyl</label>
            </div>

            <br>
            <h5>Condition</h5>
            <div class="inputLabel"><input type="checkbox" name="q-Poor" value="q-Poor" id="q-Poor" class="filterInput">
                <label for="q-Poor">Poor</label>
            </div>

            <div class="inputLabel"><input type="checkbox" name="q-Okay" value="q-Okay" id="q-Okay" class="filterInput">
                <label for="q-Okay">Okay</label>
            </div>

            <div class="inputLabel"><input type="checkbox" name="q-Great" value="q-Great" id="q-Great"
                    class="filterInput">
                <label for="q-Great">Great</label>
            </div>

            <div class="inputLabel"><input type="checkbox" name="q-Perfect" value="q-Great" id="q-Perfect"
                    class="filterInput">
                <label for="q-Perfect">Perfect</label>
            </div>
            <div class="inputLabel" style="margin-top: 0px; margin-bottom: 10px; display:flex; flex-direction: column">
                <h5 style="margin-top: 10px;">Category</h5>
                <select name="category" id="category" style="height: 30px; width: 140px; font-size: 13px">
                    <option value="c-0" default class="filterInput">All</option>
                    <option value="c-1" class="filterInput">Progressive Rock</option>
                    <option value="c-2" class="filterInput">Rock</option>
                    <option value="c-5" class="filterInput">Psychedelic Rock</option>
                    <option value="c-6" class="filterInput">Jam Band</option>
                    <option value="c-8" class="filterInput">Funk</option>
                    <option value="c-9" class="filterInput">Folk Rock</option>
                </select>

            </div>
            <a href="#" onclick="clearFilters()">Clear Filters</a>

            <div class="inputLabel" style="margin-top: 0px; display:flex; flex-direction: column">
                <h5 style="margin-top: 10px;">Sort By</h5>
                <select name="sort" id="sort" style="height: 30px; width: 140px; font-size: 13px">
                    <option value="s-title-asc" class="filterInput">A-Z</option>
                    <option value="s-title-desc" class="filterInput">Z-A</option>
                    <option value="s-price-desc" class="filterInput">price - desc</option>
                    <option value="s-price-asc" class="filterInput">price - asc</option>
                </select>

            </div>

        </form>
    </div>
    <div class="shopContent" id="shopContent">
        <?php

        foreach ($products as $product) {
            echo '<div class="productCard">';
            echo '<a href="' . site_url() . '/shop/detail/' . $product["item_id"] . '"><img src="' . $product["image"] . '"></a>';
            echo '<p class="productCard-title">' . $product["title"] . ' - ' . $product["artist"] . '</p>';
            echo '<p class="productCard-price">$' . $product["price"] . '</p>';
            echo '<p class="productCard-subtitle">' . $product["format_name"] . '</p>';
            echo '<p class="productCard-subtitle">' . $product["quality_name"] . ' Condition</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<script>
window.onload = () => {
    document.getElementById("cartNumber").innerHTML = localStorage.getItem("cartNumber");
    let filters = document.getElementsByClassName("filterInput");
    for (let i = 0; i < filters.length; i++) {
        filters[i].addEventListener('click', (event) => {
            processFilters();
        })
    }
    // Initiate alrady chosen filters via localstorage if they are set
    if (localStorage.getItem("filters")) {
        let setFilters = JSON.parse(localStorage.getItem("filters"))
        for (let i = 0; i < setFilters.length; i++) {
            if (document.getElementById(setFilters[i]) != null) {
                document.getElementById(setFilters[i]).checked = true;
            }

        }
        processFilters();
    }
}

function processFilters() {
    // Retrieve the selected filters
    let values = [];
    let url = "<?= site_url() ?>/shop/filter/"
    let formInputs = $("#filters").serializeArray();
    values = [];
    valuesString = "";
    localStorage.setItem("filters", "")
    for (let r = 0; r < formInputs.length; r++) {
        values.push(formInputs[r].value);
        localStorage.setItem("filters", JSON.stringify(values));
        let term = values[r];
        if (term != values[0]) {
            term = "_" + term;
        }
        valuesString += term;
    }

    if (values.length == 0) {
        valuesString = "empty";
    }

    let xhr = new XMLHttpRequest();
    url += valuesString
    xhr.open("GET", url, true);

    xhr.onload = () => {
        let response = JSON.parse(xhr.responseText);
        let htmlContent = ``;
        for (let i = 0; i < response.length; i++) {
            htmlContent += `<div class="productCard">
        <a href="<?= site_url() ?>/shop/detail/${response[i].item_id}"><img src="${response[i].image}"></a>
        <p class="productCard-title">${response[i].title} - ${response[i].artist} </p>
      <p class="productCard-price">$${response[i].price}</p>
       <p class="productCard-subtitle">${response[i].format_name}</p>
       <p class="productCard-subtitle">${response[i].quality_name} Condition</p>
       </div>`
        }
        document.getElementById("shopContent").innerHTML = htmlContent;
    }

    xhr.send(null);
}

function clearFilters() {
    localStorage.setItem("filters", "")
    let filters = document.getElementsByClassName("filterInput");
    for (let i = 0; i < filters.length; i++) {
        if (filters[i].checked != null) filters[i].checked = false;
    }
    processFilters();
}
</script>