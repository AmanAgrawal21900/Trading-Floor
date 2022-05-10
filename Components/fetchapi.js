function get_price_from_api(){
    //  GET request using fetch()
    var sym = document.getElementById("sym").value;
    var symb = sym.toLowerCase();
    console.log(symb);
    fetch_url = "https://cloud.iexapis.com/stable/stock/"+symb+"/quote?token=pk_3251b0d4b1fc472aaaf9a03643ed5b40";
    console.log(fetch_url);
    fetch(fetch_url)
    
    // Converting received data to JSON
    .then(response => response.json())
    .then(json => {
        let lis = `
        <tr>
            <th>
                Symbol 
            </th>
            <th>
                Company Name
            </th>
            <th>
                Currency
            </th>
            <th>
                Price
            </th>
            <th>
               % Change
            </th>
            <th>
                Primary Exchange
            </th>
        </tr>
        <tr>
            <td>`
                +json.symbol+
            `</td>
            <td>`
                +json.companyName+
            `</td>
            <td>`
                +json.currency+
            `</td>
            <td>`
                +json.iexClose+
            `</td>
            <td>`
                +json.changePercent+
            `</td>
            <td>`
                +json.primaryExchange+
            `</td>
        </tr>`
        document.getElementById("users").innerHTML = lis;
        console.log(json);       
    });
}