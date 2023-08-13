
// User
function personal_or_organization() {
    var company_type = document.getElementById("company_type");
    var company_name = document.getElementById("company_name");
    var company_position = document.getElementById("company_position")

    if (company_type.value == 1) {
        company_name.value = "N/A";
        company_position.value = "N/A";
        
        company_name.readOnly = true;
        company_position.readOnly = true;
	} 
	else if (company_type.value == 2) {
        company_name.value = "";
        company_position.value = "";

        company_name.readOnly = false;
        company_position.readOnly = false;
	} 
}


