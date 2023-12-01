<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>List</title>
  <link rel="icon" href="dist/img/ucc-logo.png">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/jqvmap/jqvmap.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="dist/css/style.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="#" class="brand-link">
        <img src="dist/img/ucc-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">EduChain</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">Registrar</a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="student.php" class="nav-link">
                <i class="nav-icon fas fa-user mr-3"></i>
                <p>Student</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="list.php" class="nav-link active">
                <i class="nav-icon fas fa-clipboard-list mr-3"></i>
                <p>List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link text-danger">
                <i class="nav-icon fas fa-power-off mr-3"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <h1 class="m-0">List</h1>
        </div>
      </div>

      <section class="content">
        <div class="container">
          <div class="card p-3">
            <div class="card p-3">
              <table id="list_dt" class="table table-striped table-bordered" style="width: 100%">
                <thead>
                  <tr>
                    <th>NAME</th>
                    <th>ACTIONS</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
    </div>
    </section>
  </div>


   <!-- edit details modal -->
   <div class="modal fade" id="store_creds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                </div>
                <div class="modal-body">
                   


                    <div class="Fullname">
                        <label>Fullname <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="Name" readonly>
                    </div>

                    <div class="Student Number">
                        <label>Student Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="StudentNumber"  readonly>
                    </div>

                    <div class="Course">
                        <label>Course <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="Course"  readonly>
                    </div>

                    <div class="Schoolyear">
                        <label>Schoolyear <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="Schoolyears" readonly >
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="save()">Update</button>
                    <input type="hidden" id="hiddendata_bc">
                </div>
            </div>
        </div>
    </div>


  <!-- good moral modal -->
  <div class="modal fade" id="goodMoralModal" tabindex="-1" role="dialog" aria-labelledby="goodMoralModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="goodMoralModalLabel">Good Moral</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body good-moral-modal text-center">
          <div class="card p-5 bg-light">
            <div class="deped-logo">
              <img src="dist/img/deped-logo.png" alt="DepEd Logo" width="210">
            </div>
            <div class="ucc-logo">
              <img src="dist/img/ucc-logo.png" alt="UCC Logo" width="120">
            </div>

            <p class="m-0">Republic of the Philippines</p>
            <p class="m-0 font-weight-bold">Department of Education</p>
            <p class="m-0">REGION VIII</p>
            <p class="m-0 font-weight-bold">DIVISION OF SOUTHERN LEYTE</p>
            <p class="m-0">District of Malitbog</p>
            <p class="m-0 font-weight-bold">CONCEPCION NATIONAL HIGH SCHOOL</p>

            <hr class="good-moral-hr">

            <h2 class="pt-4">CERTIFICATION</h2>

            <div class="text-left p-4">
              <p class="font-weight-bold">TO WHOM IT MAY CONCERN:</p>

              <p>
                <span class="text-white">******</span>This is to certify that <u>NICOLLETTE PORCA</u> is officially
                enrolled as First Year student of Concepcion National High School, Concepcion, Malitbog, Southern Leyte,
                during the school year 2008-2009.
              </p>
              <p>
                <span class="text-white">******</span>This is to certify further that he/she is a student of good moral
                character and ahs no property or financial responsibility in this school.
              </p>
              <p>
                <span class="text-white">******</span>This certification is issued upon request of the student concerned
                for his/her desire to transfer to another school.
              </p>
              <p>
                <span class="text-white">******</span>Done this 29th day of September, 2009 at Concepcion National High
                School, Concepcion, Malitbog, Southern Leyte, Philippines.
              </p>
            </div>

            <div class="text-right mt-5 pr-4">
              <p class="m-0 font-weight-bold">ROSALINA L. AGAPAY</p>
              <p class="m-0">Principal I <span class="text-white">******</span></p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="printButton()">PRINT</button>

          <input type="hidden" id="hiddendata_s">
        </div>
      </div>
    </div>
  </div>

  <!-- certification of graduation modal -->
  <div class="modal fade" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="certificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="certificateModalLabel">Certification of Graduation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="card p-5 bg-light certificate-card">
            <h3 class="certification-of-graduation">CERTIFICATE OF GRADUATION</h3>
            <p class="mt-4 mb-4">This is awarded to</p>
            <h1 class="student-name">Nicollette Loanne F. Porca</h1>
            <p class="m-0 mt-3">for successfully completing the Timpton International High School curriculum.</p>

            <div class="row text-center">
              <div class="col-sm-2"></div>
              <div class="col-sm-4">
                <hr class="certificate-hr">
                <p class="m-0 font-weight-bold school-director">Rufus Stewart</p>
                <p class="m-0">SCHOOL DIRECTOR</p>
              </div>
              <div class="col-sm-4">
                <hr class="certificate-hr">
                <p class="m-0 font-weight-bold associate-director">Irene O'Shair</p>
                <p class="m-0">ASSOCIATE DIRECTOR</p>
              </div>
              <div class="col-sm-2"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="printCert()">PRINT</button>
          <input type="hidden" id="hiddendata_certificate">
        </div>
      </div>
    </div>
  </div>


  <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/web3@1.3.6/dist/web3.min.js"></script>

  <script>
    let contract;
    let currentAccount;

    document.addEventListener('DOMContentLoaded', async () => {
      const web3 = new Web3(Web3.givenProvider || 'http://127.0.0.1:7545');

      if (typeof window.ethereum !== 'undefined') {

        const web3 = new Web3(window.ethereum);

        try {
          const accounts = await ethereum.request({
            method: 'eth_requestAccounts'
          });
          currentAccount = accounts[0]; // Assign to the higher-scoped variable

          console.log('Current Ethereum address:', currentAccount);

          const contractAddress = '0xd6ceD349B1173522429cae9A2057539b61A7A0Fe';
          const contractAbi = [
            {
      "anonymous": false,
      "inputs": [
        {
          "indexed": true,
          "internalType": "string",
          "name": "studentNumber",
          "type": "string"
        },
        {
          "indexed": false,
          "internalType": "string",
          "name": "name",
          "type": "string"
        },
        {
          "indexed": false,
          "internalType": "string",
          "name": "course",
          "type": "string"
        },
        {
          "indexed": false,
          "internalType": "string",
          "name": "schoolYear",
          "type": "string"
        },
        {
          "indexed": false,
          "internalType": "string",
          "name": "university",
          "type": "string"
        }
      ],
      "name": "StudentAdded",
      "type": "event"
    },
    {
      "inputs": [
        {
          "internalType": "string",
          "name": "_name",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "_course",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "_schoolYear",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "_studentNumber",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "_university",
          "type": "string"
        }
      ],
      "name": "addStudent",
      "outputs": [],
      "stateMutability": "nonpayable",
      "type": "function"
    },
    {
      "inputs": [
        {
          "internalType": "string",
          "name": "_name",
          "type": "string"
        }
      ],
      "name": "getStudent",
      "outputs": [
        {
          "internalType": "string",
          "name": "",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "",
          "type": "string"
        },
        {
          "internalType": "string",
          "name": "",
          "type": "string"
        }
      ],
      "stateMutability": "view",
      "type": "function",
      "constant": true
    }
  
          ];

          contract = new web3.eth.Contract(contractAbi, contractAddress);

          ethereum.on('accountsChanged', newAccounts => {
            console.log('Accounts changed:', newAccounts);
            currentAccount = newAccounts[0]; // Update the higher-scoped variable
            console.log('Updated Ethereum address:', currentAccount);
          });

          ethereum.on('chainChanged', chainId => {
            console.log('Network changed:', chainId);
          });

          ethereum.on('disconnect', (error) => {
            console.log('MetaMask disconnected:', error);
          });


          $('#list_dt').DataTable({
            'serverside': true,
            'processing': true,
            'paging': true,
            "columnDefs": [{
              "className": "dt-center",
              "targets": "_all"
            }, ],
            'ajax': {
              'url': 'list_tbl.php',
              'type': 'post',

            },
          });
        } catch (error) {
          console.error('Error fetching accounts:', error);
        }
      } else {
        console.log('MetaMask or an Ethereum-compatible wallet is not installed.');
      }
    });


    $(document).ready(function() {



    });


    function store(id) {
            $('#hiddendata_certificate').val(id);
            $.post("storeDetails.php", {
                id: id
            }, function(data,
                status) {
                var userids = JSON.parse(data);
                // console.log(userids)
                $('#Name').val(userids.fullname);
                $('#StudentNumber').val(userids.studentNumber);
                $('#Course').val(userids.course_name);
                $('#Schoolyears').val(userids.schooyear);
             

            });
            $('#store_creds').modal("show");
        }



        async function save() {
  try {
    const updateData = {
      id: $('#hiddendata_certificate').val(),
      name: $('#Name').val(),
      StudentNumber: $('#StudentNumber').val(),
      Course: $('#Course').val(),
      Schoolyears: $('#Schoolyears').val(),
      Univ: "University Of Caloocan City"
    };

    const gasEstimate = await contract.methods.addStudent(
      
      updateData.name,
   
      updateData.StudentNumber,
      updateData.Course,
      updateData.Schoolyears,
   
      updateData.Univ
   
    ).estimateGas({ from: currentAccount });

    const gasLimit = gasEstimate + 100000;

    const tx = await contract.methods.addStudent(
      updateData.name,

      updateData.StudentNumber,
      updateData.Course,
      updateData.Schoolyears,
      
      updateData.Univ
    ).send({ from: currentAccount, gas: gasLimit });

    console.log('Transaction Result:', tx);

    if (tx) {
      // If the transaction was successful, update the status in the database
      updateStatus(updateData.id);
      

    }



    // If the transaction is successful, update the status to 'approved' on the server.
    // if (tx.status === true) {
    //   const hiddendata1 = updateData.id;
    //   const response = await fetch("blockchain_approved.php", {
    //     method: 'POST',
    //     headers: {
    //       'Content-Type': 'application/x-www-form-urlencoded',
    //     },
    //     body: `hiddendata1=${encodeURIComponent(hiddendata1)}`,
    //   });

    //   if (response.ok) {
    //     // Reload DataTable (assuming you have DataTables initialized)
    //     $('#approval_tbl').DataTable().ajax.reload();
    //     alert("Store in blockchain");
    //   } else {
    //     throw new Error(`Failed to update status on the server. Status: ${response.status}`);
    //   }
    // }

    $('#store_creds').modal('hide');
  } catch (error) {
    console.error('Error:', error);
  }
}


function updateStatus(studentId) {
  // Make an AJAX request to update the status in the database
  $.ajax({
    type: 'POST',
    url: 'update_controller.php', // Replace with the actual server-side script URL
    data: { id: studentId },
    success: function(response) {
      console.log('Status updated in the database:', response);
      
      $('#list_dt').DataTable().ajax.reload();
    },
    error: function(error) {
      console.error('Error updating status in the database:', error);
    }
  });
}


    function goodmoral(id) {
      $('#hiddendata_s').val(id);
      $('#goodMoralModal').modal("show");
    }

    function printButton() {
      var studentId = $('#hiddendata_s').val();
      $.ajax({
        url: 'good-moral.php?id=' + studentId, // Include the ID in the URL
        method: 'GET',
        success: function(response) {
          // Open the generated PDF in a new window or tab
          window.open('good-moral.php?id=' + studentId, '_blank');
        },
        error: function(xhr, status, error) {
          console.error(error);
          // Provide feedback to the user (optional)
          alert('Error generating PDF. Please try again.');
        }
      });

    }


    function certOfGrad(id) {
      $('#hiddendata_certificate').val(id);
      $('#certificateModal').modal("show");
    }

    function printCert() {
      var id = $('#hiddendata_certificate').val();
      $.ajax({
        url: 'good-moral.php?id=' + id, // Include the ID in the URL
        method: 'GET',
        success: function(response) {
          // Open the generated PDF in a new window or tab
          window.open('graduation-certificate.php?id=' + id, '_blank');
        },
        error: function(xhr, status, error) {
          console.error(error);
          // Provide feedback to the user (optional)
          alert('Error generating PDF. Please try again.');
        }
      });

    }
  </script>


</body>

</html>