// Function to show the modal with dynamic content and actions
function showModal(message, confirmAction, cancelAction) {
    // Update modal message content
    document.getElementById('modalMessage').innerHTML = message;

    // Set actions for confirm and cancel buttons
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.getElementById('cancelButton');
    
    // Set up the confirm action
    confirmButton.onclick = function () {
        confirmAction();  // Execute the confirm action when "Đồng ý" is clicked
        hideModal(); // Hide modal after confirm
    };

    // Set up the cancel action
    cancelButton.onclick = function () {
        cancelAction();  // Execute the cancel action when "Hủy" is clicked
        hideModal(); // Hide modal after cancel
    };

    // Show the modal by creating a new instance of bootstrap modal
    const modalElement = document.getElementById('dynamicModal');
    const modalInstance = new bootstrap.Modal(modalElement);
    modalInstance.show();
}

// Function to hide the modal
function hideModal() {
    const modalElement = document.getElementById('dynamicModal');
    const modalInstance = bootstrap.Modal.getInstance(modalElement); // Get existing modal instance
    modalInstance.hide(); // Hide the modal
}

function submitLogoutForm() {
    const logoutForm = document.getElementById('logoutForm');
    logoutForm.submit();  
}


function submitDocumentForm(documentId) {
    const form = document.getElementById(`deleteDocumentForm-${documentId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitIndustryForm(industryId) {
    const form = document.getElementById(`deleteIndustryForm-${industryId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitFieldForm(fieldId) {
    const form = document.getElementById(`deleteFieldForm-${fieldId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitMarketForm(marketId) {
    const form = document.getElementById(`deleteMarketForm-${marketId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitGroupForm(groupId) {
    const form = document.getElementById(`deleteGroupForm-${groupId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitCertificateForm(certificateId) {
    const form = document.getElementById(`deleteCertificateForm-${certificateId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitOrganizationForm(organizationId) {
    const form = document.getElementById(`deleteOrganizationForm-${organizationId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitBusinessForm(businessId) {
    const form = document.getElementById(`deleteBusinessForm-${businessId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitClubForm(clubId) {
    const form = document.getElementById(`deleteClubForm-${clubId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitBoardCustomerForm(boardCustomerId) {
    const form = document.getElementById(`deleteBoardCustomerForm-${boardCustomerId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitBusinessCustomerForm(businessCustomerId) {
    const form = document.getElementById(`deleteBusinessCustomerForm-${businessCustomerId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitIndividualCustomerForm(individualCustomerId) {
    const form = document.getElementById(`deleteIndividualCustomerForm-${individualCustomerId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitBusinessPartnerForm(businessPartnerId) {
    const form = document.getElementById(`deleteBusinessPartnerForm-${businessPartnerId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitIndividualPartnerForm(individualPartnerId) {
    const form = document.getElementById(`deleteIndividualPartnerForm-${individualPartnerId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitSponsorshipForm(sponsorshipId) {
    const form = document.getElementById(`deleteSponsorshipForm-${sponsorshipId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitActivityForm(activityId) {
    const form = document.getElementById(`deleteActivityForm-${activityId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitRoleForm(roleId) {
    const form = document.getElementById(`deleteRoleForm-${roleId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitAccountForm(accountId) {
    const form = document.getElementById(`deleteAccountForm-${accountId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitMeetingForm(meetingId) {
    const form = document.getElementById(`deleteMeetingForm-${meetingId}`);
    console.log(form);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}

function submitNotificationForm(notificationId) {
    const form = document.getElementById(`deleteNotificationForm-${notificationId}`);
    if (form) {
        form.submit();
    } else {
        console.error("Form không tìm thấy!");
    }
}