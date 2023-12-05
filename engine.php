<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Engine</title>
    <link rel="icon" href="dist/img/ucc-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/style.css">



</head>

<body class="bg-success text-light">
    <div class="container text-center">
        <div class="card engine-card">
            <div>
                <img src="dist/img/ucc-logo.png" alt="UCC Logo" width="200">
            </div>
            <label for="studentIdInput" class="ucc-title mt-3 mb-3">UNIVERSITY OF CALOOCAN CITY</label>

            <div id="searchForm" class="input-group">
                <input type="text" id="studentIdInput" placeholder="Student Name" required
                    class="form-control form-control-lg student-input">
                <button id="searchButton" class="btn btn-secondary btn-lg search-btn">Search</button>
            </div>

            <div id="validationMessage"></div>

            <div id="studentData">
                <div id="studentName"></div>
                <div id="studentCourse"></div>
                <div id="studentSchoolYear"></div>
                <div id="studentNumber"></div>
                <div id="studentUniversity"></div>
            </div>
        </div>
    </div>

    <!-- <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                    const contractAbi = [{
                        "anonymous": false,
                        "inputs": [{
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
                        "inputs": [{
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
                        "inputs": [{
                            "internalType": "string",
                            "name": "_name",
                            "type": "string"
                        }],
                        "name": "getStudent",
                        "outputs": [{
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
                } catch (error) {
                    console.error('Error fetching accounts:', error);
                }
            } else {
                console.log('MetaMask or an Ethereum-compatible wallet is not installed.');
            }
        });

        $(document).ready(function () {
            $('#searchButton').on('click', function () {
                searchStudent();
            });
        });

        async function searchStudent() {
            try {
                const studentNumber = $('#studentIdInput').val();

                const studentData = await contract.methods.getStudent(studentNumber).call();

                for (const key in studentData) {
                    if (studentData[key] !== '') {
                        // Student data has at least one non-empty value
                        console.log('Student Is Valid');
                        console.log(studentData);

                        var name = studentData[0];
                        var studentnumber = studentData[1];
                        var course = studentData[2];
                        var schoolyear = studentData[3];
                        var univ = studentData[4];

                        // var formattedString = `${name} .'<'. ${course}'s \n ${univ} \n ${schoolyear}.`;
                        Swal.fire({
                            title: 'Student Exist!',
                            html: `${name} <br> ${course} <br> ${univ} <br> ${schoolyear}`,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        .then(() => {
                            // Reload the page when the user clicks "OK"
                            location.reload();
                        });


                        break; // Stop iterating as data is found
                    } else {
                        console.log('no Student record found!');

                        Swal.fire({
                            title: 'No record found!',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        }).then(() => {
                            // Reload the page when the user clicks "OK"
                            location.reload();
                        });

                        break;
                    }

                }


            } catch (error) {
                console.error('Error searching student:', error);
            }
        }


        function displayValidationMessage(message) {
            $('#validationMessage').text(message);
        }
    </script>
</body>

</html>