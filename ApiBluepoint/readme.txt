#windows���ApiBluepoint���g�p����

���Q�l�T�C�g
http://qiita.com/taipon_rock/items/9001ae194571feb63a5e
http://imamotty.hatenablog.jp/entry/2015/01/18/033222


##node���C���X�g�[������
�ȉ���URL����C���X�g�[������
https://nodejs.org/en/download/

###cmd�ňȉ������s���Ċm�F����
node --version

�o�[�W�������\��������OK

###npm�̃C���X�g�[�����m�F����
npm --version

�o�[�W�������\��������OK

##npm��gulp���O���[�o���C���X�g�[�����܂��B

###cmd�ňȉ������s
npm install -g gulp

###�C���X�g�[���m�F
gulp -v

�o�[�W�������\��������OK

##��ƃt�H���_���쐬����

cmd�ňȉ������s
mkdir ~/apiblueprint ����ƃt�H���_��
cd ~/apiblueprint
npm init

##gulp��gulp-aglio�����[�J���C���X�g�[��

gulp��gulp-aglio����ƃf�B���N�g���Ƀ��[�J���C���X�g�[�����Ă��������B
npm install gulp gulp-aglio --save-dev

##API Blueprint�L�@��API�̈ꗗ������

##docs�^�X�N�����s����HTML��API�h�L�������g���쐬

gulp docs

