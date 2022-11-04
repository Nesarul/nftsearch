<!DOCTYPE html>
<html lang="en">
<head>
    <title>NFT Search Engine</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="Search millions of NFTs on 10 different blockchains, all in one search" name="description" />
    <meta content="NFT, crypto, blockchains, NFT search, NFTs" name="keywords" />
    <script src="/nftsearch/assets/js/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="/nftsearch/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/nftsearch/assets/css/styles.css">
</head>
        <main class="container text-white">
  			<?php include 'header.php';?>
            <div id="overlay" style="display: none;">
                <div id="loading"><img src="/nftsearch/assets/images/loading.gif" class="img-fluid"></div>
            </div>

            <div class="row mt-5">
                <div class="col-12 text-center mb-3">
                    <h1 style="color:#102747">NFT Search Engine</h1>
                </div>
                <div class="col-12">

                    <div class="form-group has-search">
							<button type="submit" class="form-control-feedback" id="srcBtn">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
								</svg>
							</button>
							<input type="text" class="form-control lead bg-light" placeholder="Search" id="question" name="question">
						</div>
                    <!-- </form> -->
                </div>
                <div class="col-12">
                    <div class="row" id="resDivs">
                       
                    </div>
                    <div class="d-flex justify-content-center">
                        <button id="btn24" type="button" class="btn btn-primary d-none align-self-center">More Results</button>
                    </div>
                    
                </div>
            </div>
        </main>
 
<script>
    // Declare Two global variable. 
    // 1. hold the criteria. 
    // 2. hold the count page. 
    // 3. 

    // var criteria = $('input[name=question]').val();
    var criteria = null;
    var pageNo = 0;         // Set Default to 0.
    var totalPage = 0;
    $('#btn24').on('click',function(){
        $('#srcBtn').trigger('click');
    });
    $(function(){
        $('#question').on('keyup', function(e){
            e.keyCode == 13 ? $('#srcBtn').trigger('click') : null;
        });
        $('#srcBtn').on('click',function(){
            if(criteria != $('input[name=question]').val())
            {
                criteria = $('input[name=question]').val();
                pageNo = 0;
                totalPage = 0;
                $('#resDivs').empty();
            }
                
            pageNo ++;

            $.ajax({
                type:'POST',
                url:'api_nftsearch.php',
                sync: true,
                data: {
                    q : criteria,
                    s : (pageNo-1) * 24,
                    e : pageNo * 24,
                },
                dataType:'JSON',
                success:function(data){
                    $('#resDivs').append(data['records']);
                   
                    if(data['total'] <= 24)
                        totalPage = 1; 
                    else{
                        if(totalPage == 0 && data['err'] != "NR")
                        {
                            of = data['total'] % 24;
                            tp = data['total'] - of;
                            totalPage = (tp / 24) + (of > 0 ? 1 : 0);
                            if(totalPage > 1)
                                $('#btn24').removeClass('d-none').addClass("d-block")
                        }
                    }
                    pageNo >= totalPage ? $('#btn24').removeClass('d-block').addClass("d-none") : null;
                    
                },
                error:function(data){
                    alert("Failed");
                },
            });
        })
    });
  
    showForeign = () =>{
   
}
</script>
    </div>
    <BR>
<?php include 'footer_menu.php'; ?>

</body>
</html>