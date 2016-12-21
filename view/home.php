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
				render() {
					return (
						<tr>
							<td>{this.props.nama}</td>
							<td>{this.props.kelas}</td>
							<td>{this.props.act}</td>
						</tr>
					);
				}
			}
      class Tambah extends React.Component {
        render() {
          return (
            <form>
              <input className="form-control tambah" type="text" placeholder="nama" />
              <input className="form-control tambah" type="text" placeholder="kelas" />
              <input className="btn btn-primary tambah" type="submit" value="tambah" />
            </form>
          );
        }
      }
			class Crud extends React.Component {
        constructor(props) {
          super(props);
          this.ubah = this.ubah.bind(this);
          this.state = {
            filter:"",
            data:[]
          };
        }
        ubah(filter) {
          this.setState({
            filter:filter
          });
        }
        componentDidMount() {
          $.get("http://localhost/carNA",function(res) {
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
						baris.push(<Row nama={data.nama} kelas={data.kelas} act='hapus' />);
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
              <Tambah />
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
