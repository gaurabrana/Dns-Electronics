$(document).ready(function() {

    $(".chooseMembership").on("click", function() {
        let elementid = $(this).attr("id");
        let mid = elementid.split("packageid")[1];
        let data = { "id": mid, "action": "addMembership" };
        console.log("clicked");
        $.ajax({
            url: "database/managemembership.php",
            data: data,
            type: "POST",
            cache: false,
            success: function(response) {
                let result = JSON.parse(response);
                console.log(result);
                if (result.statusCode == 200) {
                    toastr.success('Membership has been added successfully this the account.', 'Success!!');
                } else if (result.statusCode == 201) {
                    toastr.error('Failed to add membership to this account.', 'Failure!!');
                } else if (result.statusCode == 202) {
                    toastr.error('Please login to activate this membership.', 'Failure!!');
                }
            }
        });
    });
});