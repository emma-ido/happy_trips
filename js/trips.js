

function validateNewTrip() {
	var departure_time = $('#departure_time');
	var arrival_time = $('#arrival_time');

	// console.log(departure_time.val());
	// console.log(arrival_time.val());

	var departureTime = new Date(departure_time.val());
	var arrivalTime = new Date(arrival_time.val());

	// console.log(departureTime.getTime() == arrivalTime.getTime());

	if(departureTime.getTime() >= arrivalTime.getTime()) {
		$('#invalid_time').html("Arrival Time must be after departure time");
		$('#invalid_time').css("display", "inline-block");
		return;
	} else {
		$('#invalid_time').css("display", "none");
	}

	$('#add_new_trip_trigger').click();
}


function conFirmBooking() {
	var seatsSelected = $('#seats').text();

	if(seatsSelected > 0) {
		$('#trigger_button').click();
	} else {
		$('#select_seat_error').css("display", "");
		setTimeout(clearError, 5000);	
	}
}

function clearError() {
	$('#select_seat_error').css("display", "none");
}

function changeSeatImage(id) {
	const imageObject  = $('#' + 'seat_image' + id);

	const pricePerSeat = $('#price_per_seat').text();
	const totalPriceVal = $('#total_price');
	var seatsSelected = $('#seats').text();
	var totalFare = $('#total_fare').text();

	if(imageObject.attr('src') == '../images/seat_selection/selected_seat.svg') {
		imageObject.attr('src', '../images/seat_selection/available_seat.svg');
		$('#seat_' + id).attr('checked', false);
		// deselecting
		seatsSelected--;
		totalFare = seatsSelected * pricePerSeat;
	} else if(imageObject.attr('src') == '../images/seat_selection/available_seat.svg') {
		// selecting
		imageObject.attr('src', '../images/seat_selection/selected_seat.svg');
		$('#seat_' + id).attr('checked', true);
		seatsSelected++;
		totalFare = seatsSelected * pricePerSeat;
	}

	// if(parseInt(seatsSelected) > 0) {
	// 	$('#trigger_button').removeClass("disabled");
	// 	$('#trigger_button').attr("calss", "disabled");
	// } else {
	// 	$('#trigger_button').addClass("disabled");
	// 	$('#trigger_button').removeAttr("disabled");
	// }
	totalPriceVal.val(totalFare);
	$('#seats').text(seatsSelected);
	$('#seats_summary').text(seatsSelected);
	$('#total_fare').text(totalFare);
	$('#amount').text(totalFare);
}

function oneWay() {
	$('#return_date_div').css("display", "none");
	$('#has_return').val("NO");
	$('#roundTrip').removeClass("active");
	$('#oneWay').addClass("active");
}

function roundTrip() {
	$('#has_return').val("YES");
	$('#return_date_div').css("display", "");
	$('#oneWay').removeClass("active");
	$('#roundTrip').addClass("active");
}

function validateFindTripForm() {
	var travellingTo = $("#travelling_to option:selected").text();
	var travellingFrom = $("#travelling_from option:selected").text();
	var hasReturn = $("#has_return").val();
	const departure_date = new Date($("#departure_date").val());


	if(travellingTo == travellingFrom) {
		alert("Origin and destination cannot be the same");
		return;
	}

	if(hasReturn == "YES") {
		const return_date = new Date($("#return_date").val());
		if(return_date.getTime() < departure_date.getTime()) {
			alert("Return date must be on or after departure date");
			return;
		}
	}
	// console.log("here");
	document.getElementById("submit_button").click();
}

function payWithPaystack() {
	$('#exampleModal').modal('hide');
  event.preventDefault();

  let handler = PaystackPop.setup({
    // key: 'pk_test_xxxxxxxxxx', // Replace with your public key
    // my test_key: pk_test_618b2a128cb38615a9db7357f9d5e8b5b85ebb13
    // live key: pk_live_bd5356607a881f3a0d6843b75d3172b74b9675cd
    key: 'pk_test_618b2a128cb38615a9db7357f9d5e8b5b85ebb13',
    email: document.getElementById("email-address").value,
    currency: 'GHS',
    amount: document.getElementById("amount").innerText * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
      alert('Window closed.');
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      // alert(response);
      // console.log(response);

      if(response.status == "success") {
      	// $.get('../actions/process_paystack.php?ref=' + response.reference, function(data) {
        // 	alert(data);
      	// });	
      	demo(3000);
      	$('#select_seats_form').submit();
      } else {
      	alert("Transaction Failed!");
      }
      

      // $('#select_seats_form').submit();
    
    }
  });

  handler.openIframe();
}


function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function demo(i) {
	await sleep(i * 1000);  
}