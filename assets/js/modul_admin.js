 $(document).ready(function(){
      console.log('Ya ALLAHHH!!!!');
        
 ambilData();
         });

function ambilData(){
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()."index.php/admin/buku/ambilData/"?>',
            dataType:'JSON',
            success:function(data){
                var baris='';
                var nomor=1;
                for(var i=0; i<data.length; i++){
                    baris += '<tr>' +
                                    '<td>' + nomor + '</td>' + 
                                    '<td>' + data[i].kode + '</td>' +                      
                                    '<td>' + data[i].judul + '</td>' + 
                                    '<td>' + data[i].penulis + '</td>' + 
                                    '<td>' + data[i].penerbit + '</td>' + 
                                    '<td>' + data[i].tahun + '</td>' + 
                                    '<td>' + data[i].stok + '</td>' + 
                                    '<td>' +  
                                        '<a href="<?php echo base_url()."index.php/admin/buku/readFile/"?>' + data[i].id + '" target="_blank" rel="nofollow" class="btn btn-primary" >' +
                                            ' <div class="fa fa-book"></div> Read' +
                                        '</a>' +
                                        
                        
                        
                                    '</td>' + 
                                    '<td>' + i + '</td>' + 
                        
                        
                                    '</tr>';
                    nomor++;
                    
                }
            $('#target_buku').html(baris);
                
            }
        });
}
     