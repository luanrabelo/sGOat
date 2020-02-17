<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
	
</head>

<body>
	
<div>	
<p><strong>Creating/editing a project </strong></p>
<p>To create a project in sGOat, click on &ldquo;<strong>Options</strong>&rdquo; and then &ldquo;<strong>Create a new project</strong>&rdquo; in the menu tab (Figure 1), which loads the project screen for the user (Figure 2).</p>
<figure>
<p align="center"><img src="img_manual/Imagem5.png" width="75%" height="75%" alt="Figure 1"/>
<figcaption>Figure 1. Menu used to access the registration screen.</figcaption>
</figure>
<p>At the project registration screen (Figure 2), the user must insert the name of the project in the “Insert project name here” field. Neither special characters nor spaces can be inserted into this field, which is limited to 42 characters. This field is required and cannot be modified subsequently.
On this page, the user can insert a short description of the project, for reference purposes. This field is optional and can be edited or updated later. 
</p>
<figure>
<p align="center"><img src="img_manual/Imagem6.png" width="75%" height="75%" alt="Figure 2"/>
<figcaption>Figure 2. sGOat registration screen.</figcaption>
</figure>
<p><strong>Uploading sequences</strong></p>
<p>Once the project has been created, the user can add sequences. For this, on the initial sGOat screen (Figure 3), the user clicks on the “Import Sequences” option and then on the project to which the sequences should be added (Figure 4).</p>	
<figure>
<p align="center"><img src="img_manual/Imagem7.png" width="75%" height="75%" alt="Figure 3"/>
<figcaption>Figure 3. Initial screen with the projects registered.</figcaption>
</figure>
<br>
<figure>
<p align="center"><img src="img_manual/Imagem8.png" width="75%" height="75%" alt="Figure 4"/>
<figcaption>Figure 4. Options for importing a file into the project.</figcaption>
</figure>
<p>The upload screen will now be loaded (Figure 5). On this screen, the user clicks on the browser and then searches for the “.fasta” file to be added to the project. Only one file can be added at a time. When the user clicks on “Import FASTA file”, the file is sent to the server for processing, although the capacity of the server may limit the size of the file that can be processed.</p>
<figure>
<p align="center"><img src="img_manual/Imagem9.png" width="75%" height="75%" alt="Figure 5"/>
<figcaption>Figure 5. Uploading FASTA file to the project.</figcaption>
</figure>
<p>Once the file has been processed and added to the database, a message of confirmation is displayed, and sGOat returns to the initial page.</p>
<p><strong>Running sGOat</strong></p>
<p>At this stage, the user can click on “Show Sequences” to see a list of the sequences that have been added to the project and initiate the annotation process.</p>
<p>To compare the sequences stored in a project with a database, the user clicks on “Run sGOat” and then “Run BLAST” (Figure 06), which will load the screen of comparative parameters (Figure 07).</p>
<figure>
<p align="center"><img src="img_manual/Imagem10.png" width="75%" height="75%" alt="Figure 6"/>
<figcaption>Figure 6. Comparing sequences with a database.</figcaption>
</figure>
<figure>
<p align="center"><img src="img_manual/Imagem11.png" width="75%" height="75%" alt="Figure 7"/>
<figcaption>Figure 7. Parameters for comparison.</figcaption>
</figure>	
<p>Here (Figure 7), the user defines the BLAST algorithm to be used for the comparisons in sGOat, with BLASTx as the default algorithm. The default database for annotation is Swiss-Prot.
The other required parameters are the e-value, the number of hits the user wants to visualize, and the number of CPUs to be used by the BLAST.</p>
<p>The annotation process is initiated in sGOat when the user clicks on START.</p>	
<p><strong>Exporting files</strong></p>
<p>Once the project has been annotated, sGOat allows the user to obtain a new FASTA file containing only the sequences that have received at least one positive hit in the comparison. A FASTA file containing the sequences that have received no positive hits whatsoever can also be obtained. The user can also generate a native file to be used in WEGO or any more recent program that uses this kind of approach. The option to export these different files is shown in Figure 8.</p>
<figure>
<p align="center"><img src="img_manual/Imagem12.png" width="75%" height="75%" alt="Figure 8"/>
<figcaption>Figure 8. Exporting files.</figcaption>
</figure>
<p><strong>Searching for sequences</strong></p>
<p>Once the project has been annotated, sGOat allows the user to search for specific terms in a project, which may be those contained in the description, the GO code or the functions (Figure 9). </p>
<figure>
<p align="center"><img src="img_manual/Imagem13.png" width="75%" height="75%" alt="Figure 9"/>
<figcaption>Figure 9. Sequence search.</figcaption>
</figure>
<p>A list of the results of the search term is then displayed (Figure 10). A new file in FASTA format can be generated with the results of the search term, reducing the size of the file to facilitate its use in other analyses, to be run later. A WEGO file can also be generated with the search functions (Figure 11).</p>
<figure>
<p align="center"><img src="img_manual/Imagem14.png" width="75%" height="75%" alt="Figure 10"/>
<figcaption>Figure 10. List of the results of the search term.</figcaption>
</figure>
<br>
<figure>
<p align="center"><img src="img_manual/Imagem15.png" width="75%" height="75%" alt="Figure 11"/>
<figcaption>Figure 11. Generating FASTA files with the search term.</figcaption>
</figure>
<p><strong>Results</strong></p>
<p>The results of the comparisons are made available to the user and can be accessed in the sequence display screen (Figure 12) by clicking on the number of results obtained for a given sequence found in the #Hits column. The results are displayed when the user clicks on the number in the #Hits table (Figure 13). </p>
<figure>
<p align="center"><img src="img_manual/Imagem16.png" width="75%" height="75%" alt="Figure 12"/>
<figcaption>Figure 12. Accessing the results of the sequences.</figcaption>
</figure>
<br>
<figure>
<p align="center"><img src="img_manual/Imagem17.png" width="75%" height="75%" alt="Figure 13"/>
<figcaption>Figure 13. List of best hits sequences for comparison.</figcaption>
</figure>	
</div>	
</body>
</html>