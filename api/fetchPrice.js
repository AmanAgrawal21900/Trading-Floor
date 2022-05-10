async function get_price(){
    //  GET request using fetch()
    var data = [];
    var sym = document.getElementById("sym").value;
    var symb = sym.toLowerCase();
    fetch_url = "https://cloud.iexapis.com/stable/stock/"+symb+"/quote?token=pk_3251b0d4b1fc472aaaf9a03643ed5b40";
    console.log(fetch_url);

    var response = await fetch(fetch_url);
    var response = await response.json();
    
    var sname = response['companyName'];
    var price = response['iexRealtimePrice'];

    data['sname'] = sname;
    data['price'] = price;
    console.log(2);
    //console.log(data);
    return data;
}
