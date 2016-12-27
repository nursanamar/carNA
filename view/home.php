<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>
 <html lang="en">
 <head>
	 <title></title>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="../carNA/assets/css/bootstrap.css" type="text/css"/>
	 <style>
	 .cari {
	 	width:50%;
	 	margin-bottom:5%;

	 }
   .tambah {
     margin : 2%;
   }

	 </style>
	 <script src="../carNA/assets/js/react.min.js"></script>
	 <script src="../carNA/assets/js/react-dom.min.js"></script>
	 <!--<script src="../assets/js/ajax.js"></script>-->
   <script src="../carNA/assets/js/jquery.min.js">
   </script>
	 <script src="../carNA/assets/js/browser.min.js"></script>
 </head>
	 <body>
		<div  id="container"></div>
		<script type="text/babel">

			class Cari extends React.Component {
        constructor(props) {
          super(props);
          this.ubah = this.ubah.bind(this);
        }
        ubah(e) {
          this.props.event(e.target.value);
        }
				render() {
					return <input className='cari' type="text" placeholder='search....' value={this.props.value} onChange={this.ubah} />;
				}
			}
			class Row extends React.Component {
				constructor(props) {
					super(props);
					this.hapus = this.hapus.bind(this);
					this.edit = this.edit.bind(this);
				}
				hapus(e) {
					this.props.act(this.props.nama);
					e.preventDefault();
				}
				edit(e) {
					this.props.acte(this.props.nama,this.props.kelas);
					e.preventDefault();
				}
				render() {
					return (
						<tr>
							<td>{this.props.nama}</td>
							<td>{this.props.kelas}</td>
							<td><a className="btn btn-danger btn-xs" onClick={this.hapus} >hapus</a> <a className="btn btn-default btn-xs" onClick={this.edit} > edit</a> </td>
						</tr>
					);
				}
			}
			class Crud extends React.Component {
        constructor(props) {
          super(props);
          this.ubah = this.ubah.bind(this);
          this.tombolcancel = this.tombolcancel.bind(this);
          this.tomboledit = this.tomboledit.bind(this);
          this.cekmode = this.cekmode.bind(this);
        this.tambah = this.tambah.bind(this);
          this.hapus = this.hapus.bind(this);
          this.inputKelas = this.inputKelas.bind(this);
          this.inputNama = this.inputNama.bind(this);
          this.state = {
            filter:"",
            data:[],
            status:"",
            kelas:"",
            nama:"",
            mode:'tambah',
            where:''
          };
        }
        inputKelas(e) {
        	this.setState({
        		kelas:e.target.value
        	});
        }
        inputNama(e) {
        	this.setState({
        		nama:e.target.value
        	});
        }
        tomboledit(nama,kelas) {
        	this.setState({
        		nama:nama,
        		kelas:kelas,
        		where:nama,
        		mode:'edit',
        		cancel:<a className='btn btn-danger' onClick={this.tombolcancel}>batal</a>
        	});
        }
        tombolcancel() {
        	this.setState({
        		nama:'',
        		kelas:'',
        		where:'',
        		mode:'tambah',
        		cancel:''
        	});
        }
        cekmode() {
        	if(this.state.mode === 'tambah'){
        		this.tambah();
        	}else{
        		this.update();
        	}
        }
        update() {
        	$.post("http://mirip.esy.es/carNA/index.php?/home/ubah",{"nama":this.state.nama,"kelas":this.state.kelas,"where":this.state.where},function(){
        		this.componentDidMount();
        	}.bind(this));
        	this.setState({
        		nama:'',
        		kelas:'',
        		where:'',
        		mode:'tambah',
        		cancel:''
        	});
        }
        tambah() {
        	$.post("http://mirip.esy.es/carNa/index.php?/home/tambah",{"nama":this.state.nama,"kelas":this.state.kelas},function(res){
        	this.setState({
        		status: res
        	});
        	}.bind(this));
        	this.componentDidMount();
        	this.setState({
        		nama:"",
        		kelas:""
        	});
        }
        hapus(nama) {
        	$.post("http://mirip.esy.es/carNA/index.php?/home/hapus",{'nama':nama},function(res){
        		this.setState({
        			status:res
        		});
        		this.componentDidMount();
        	}.bind(this));
        	
        }
        ubah(filter) {
          this.setState({
            filter:filter
          });
        }
        componentDidMount() {
          $.get("http://mirip.esy.es/carNA",function(res) {
            this.setState({
              data: JSON.parse(res)
            });
          }.bind(this));

        }
				render() {
					var baris	 = [];
					this.state.data.forEach(data => {
            if(data.nama.indexOf(this.state.filter) === -1 ){
              return;
            }
						baris.push(<Row nama={data.nama} kelas={data.kelas} act={this.hapus} acte={this.tomboledit} />);
					});
					return (
						<div className='col-sm-4 col-sm-offset-4'>
						<h1>Tabel CRUD</h1>
							<Cari event={this.ubah} value={this.state.filter} />
							<table className='table table-striped table-responsive'>
							<thead>
								<td>Nama</td>
								<td>Kelas</td>
								<td>aksi</td>
							</thead>
							<tbody>
								{baris}
								</tbody>
							</table>
              				<div>
              				 <input className="form-control tambah" type="text" placeholder="nama" value={this.state.nama} onChange={this.inputNama} />
              <input className="form-control tambah" type="text" placeholder="kelas" value={this.state.kelas} onChange={this.inputKelas} />
              <a className='btn btn-primary' onClick={this.cekmode} > {this.state.mode} </a> {this.state.cancel}
              				</div>
						</div>
					);
				}
			}
			var data = [{"nama":"nsma","kelas":"ndat "},{"nama":"nursan","kelas":"XII TKJ 2"},{"nama":"ina","kelas":"XII TKJ "},{"nama":"rahmat","kelas":"XII TKJ 1"}];
			ReactDOM.render(
				<Crud />,
				document.getElementById("container")
			);
		</script>
	 </body>
 </html>